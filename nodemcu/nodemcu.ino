/*
 * Hybrid-IoT NodeMCU Source Code
 * Coded by Taewon Kim
 */

#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <LiquidCrystal_I2C.h>
#include <dht11.h>
#include <SoftwareSerial.h>
#include <MHZ19.h>

/* DEVICE_ID: Enter 6-digit unique ID for recognizing the device information. 
 *  ID should be formatted as Country, City, District, Village, and 2-digit number.
 * DEVICE_MODEL: Enter name of the hardware.
 * DEVICE_REGISTER_DATE: Enter the device's first running date. (YY/MM/DD)
 */
#define DEVICE_ID ""
#define DEVICE_MODEL "ESP8266" 
#define DEVICE_REGISTER_DATE ""

String database_host = "http://url";

#define WIFI_SSID "ssid" // WiFi Information
#define WIFI_PASS "password"

WiFiClient client;
HTTPClient http;
LiquidCrystal_I2C lcd(0x27, D1, D2);

SoftwareSerial ss(D7,D8);
MHZ19 mhz(&ss);
dht11 DHT11;

void setup()
{
  Serial.begin(115200); // Set boardrate to 115200

  WiFi.begin(WIFI_SSID, WIFI_PASS);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connecting to ");
  Serial.println(WIFI_SSID);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  lcd.begin(); // Start LCD display
  lcd.backlight();
  lcd.clear();

  pinMode(D0, OUTPUT); // Set LEDs to output mode
  pinMode(D4, OUTPUT);

  ss.begin(9600);
}

int getAirScore(int co2, int temp, int humi)
{
  int score = 100;

  // CO2 score calculation
  if(co2 >= 900) score = score - 30;
  else if(co2 >= 850 && co2 < 900) score = score - 26;
  else if(co2 >= 800 && co2 < 850) score = score - 22;
  else if(co2 >= 750 && co2 < 800) score = score - 18;
  else if(co2 >= 700 && co2 < 750) score = score - 14;
  else if(co2 >= 650 && co2 < 700) score = score - 10;
  else if(co2 >= 600 && co2 < 650) score = score - 6;
  else if(co2 >= 550 && co2 < 600) score = score - 2;
  else if(co2 < 550) score = score - 0;

  // Temperature score calculation
  if(temp >= 40) score = score - 30;
  else if(temp >= 37 && temp < 40) score = score - 26;
  else if(temp >= 35 && temp < 37) score = score - 22;
  else if(temp >= 33 && temp < 35) score = score - 18;
  else if(temp >= 31 && temp < 33) score = score - 14;
  else if(temp >= 29 && temp < 31) score = score - 10;
  else if(temp >= 27 && temp < 29) score = score - 6;
  else if(temp >= 26 && temp < 27) score = score - 2;
  else if(temp >= 21 && temp < 26) score = score - 0;
  else if(temp >= 19 && temp < 21) score = score - 2;
  else if(temp >= 17 && temp < 19) score = score - 6;
  else if(temp >= 15 && temp < 17) score = score - 10;
  else if(temp >= 17 && temp < 19) score = score - 14;
  else if(temp >= 19 && temp < 21) score = score - 18;
  else if(temp >= 21 && temp < 23) score = score - 22;
  else if(temp >= 23 && temp < 25) score = score - 26;
  else if(temp < 23) score = score - 30;

  // Humidity score calculation
  if(humi >= 78) score = score - 30;
  else if(humi >= 75 && humi < 78) score = score - 26;
  else if(humi >= 72 && humi < 75) score = score - 22;
  else if(humi >= 69 && humi < 72) score = score - 18;
  else if(humi >= 66 && humi < 69) score = score - 14;
  else if(humi >= 63 && humi < 66) score = score - 10;
  else if(humi >= 60 && humi < 63) score = score - 6;
  else if(humi >= 55 && humi < 60) score = score - 2;
  else if(humi >= 45 && humi < 55) score = score - 0;
  else if(humi >= 40 && humi < 45) score = score - 2;
  else if(humi >= 37 && humi < 40) score = score - 6;
  else if(humi >= 34 && humi < 37) score = score - 10;
  else if(humi >= 31 && humi < 34) score = score - 14;
  else if(humi >= 28 && humi < 31) score = score - 18;
  else if(humi >= 25 && humi < 28) score = score - 22;
  else if(humi >= 22 && humi < 25) score = score - 26;
  else if(humi < 22) score = score - 30;
  
  return score;
}

String status;
void validate(int num)
{
  if(num > 0) status="True";
  else status="False";
}

void loop()
{                        
  int chk = DHT11.read(D5);
  int airScore = getAirScore(mhz.getCO2(), DHT11.temperature, DHT11.humidity);
  
  Serial.print("\nHumidity: "); // Get humidity value from DHT11 sensor             
  Serial.print((float)DHT11.humidity, 2);
  Serial.println("%");       
  Serial.print("Temperature: "); // Get temperature value from DHT11 sensor             
  Serial.print((float)DHT11.temperature, 2);
  Serial.println("C");
  Serial.print(F("CO2: "));
  Serial.println(mhz.getCO2());
  Serial.print("AirScore: ");             
  Serial.println(airScore);
  
  lcd.clear(); // Display Temperature and Humidity to LCD display
  lcd.print("Temp:");
  lcd.setCursor(6,0);
  lcd.print((float)DHT11.temperature, 0);
  lcd.setCursor(9,0);
  lcd.print("C");

  lcd.setCursor(12,0);
  lcd.print("CO2:");
  lcd.setCursor(12,1);
  lcd.print(mhz.getCO2());
  
  lcd.setCursor(0,1);
  lcd.print("Humi:");
  lcd.setCursor(6,1);
  lcd.print((float)DHT11.humidity, 0);
  lcd.setCursor(9,1);
  lcd.print("%");

  if (DHT11.temperature > 28 || DHT11.temperature < 18)
  {
    digitalWrite(D0, LOW); // Turn on red LED and turn off green LED
    digitalWrite(D4, HIGH);             
  }else{
    digitalWrite(D0, HIGH); // Turn on green LED and turn off red LED
    digitalWrite(D4, LOW);
  }

  validate(airScore);
  
  String webhost = database_host + "/api/insert.php?device_id="+String(DEVICE_ID)+"&airscore="+String(airScore)+"&co2="+String(mhz.getCO2())+"&temperature="+String((float)DHT11.temperature, 0)+"&humidity="+String((float)DHT11.humidity, 0);
  http.begin(client, webhost);
  http.setTimeout(1000);
  int httpCode = http.GET();
  
  if(httpCode > 0) {
    Serial.printf("\nGET result : %d\n\n", httpCode);
 
    if(httpCode == HTTP_CODE_OK) {
      String payload = http.getString();
      Serial.println(payload);
    }
  }else{
    Serial.printf("\nGET failed, error: %s\n", http.errorToString(httpCode).c_str());
  }
  http.end();

  delay(10000); // Delay 10 seconds
}
