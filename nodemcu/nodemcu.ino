/*
 * Hybrid-IoT NodeMCU Source Code
 * Coded by Taewon Kim
 */

#include <ESP8266WiFiMulti.h>
#include <InfluxDb.h>
#include <LiquidCrystal_I2C.h>
#include <dht11.h>

/* INFLUXDB_HOST: Enter the host address of the InfluxDB server.
 * INFLUXDB_PORT: Default value is 8086. Change this value if you've changed the InfluxDB port.
 * INFLUXDB_DATABASE: Enter name of the database which the data will be inserted.
 * INFLUXDB_USER/PASS: Enter the username/password of the InfluxDB for authentication.
 */
#define INFLUXDB_HOST "address"
#define INFLUXDB_PORT 8086
#define INFLUXDB_DATABASE "database"
#define INFLUXDB_USER "user"
#define INFLUXDB_PASS "password"

/* DEVICE_ID: Enter 6-digit unique ID for recognizing the device information. 
 *  ID should be formatted as Country, City, District, Village, and 2-digit number.
 * DEVICE_NAME: Enter name of the hardware.
 * DEVICE_LOCATION: Enter location.
 * DEVICE_REGISTER_DATE: Enter the device's first running date. (YY/MM/DD)
 */
#define DEVICE_ID ""
#define DEVICE_NAME "ESP8266" 
#define DEVICE_LOCATION "location"
#define DEVICE_REGISTER_DATE ""

#define WIFI_SSID "ssid" // WiFi Information
#define WIFI_PASS "password"

ESP8266WiFiMulti WiFiMulti;
LiquidCrystal_I2C lcd(0x27, D1, D2);
Influxdb influx(INFLUXDB_HOST, INFLUXDB_PORT); // Connect to InfluxDB
dht11 DHT11;

void setup()
{
  Serial.begin(115200); // Set boardrate to 115200

  WiFiMulti.addAP(WIFI_SSID, WIFI_PASS); // Connect to WiFi
  while (WiFiMulti.run() != WL_CONNECTED) {
    delay(100); // Delay 0.1 seconds
  }
  Serial.println("WiFi has been connected");
  Serial.print("IP: ");
  Serial.println(WiFi.localIP());

  influx.setDbAuth(INFLUXDB_DATABASE, INFLUXDB_USER, INFLUXDB_PASS);

  lcd.begin(); // Start LCD display
  lcd.backlight();
  lcd.clear();

  pinMode(D0, OUTPUT); // Set LEDs to output mode
  pinMode(D4, OUTPUT);
}

void loop()
{                        
  int chk = DHT11.read(D5);                   
  Serial.print("\nHumidity: "); // Get humidity value from DHT11 sensor             
  Serial.print((float)DHT11.humidity, 2);
  Serial.println("%");       
  Serial.print("Temperature: "); // Get temperature value from DHT11 sensor             
  Serial.print((float)DHT11.temperature, 2);
  Serial.println("C");  
  delay(2000); // Delay 2 seconds
  
  lcd.clear(); // Display Temperature and Humidity to LCD display
  lcd.print("Temp:");
  lcd.setCursor(6,0);
  lcd.print((float)DHT11.temperature, 0);
  lcd.setCursor(9,0);
  lcd.print("C");
  
  lcd.setCursor(0,1);
  lcd.print("Humi:");
  lcd.setCursor(6,1);
  lcd.print((float)DHT11.humidity, 0);
  lcd.setCursor(9,1);
  lcd.print("%");

  if (DHT11.temperature > 30) // If temperature value is higher than 30 degrees
  {
    digitalWrite(D0, LOW); // Turn on red LED and turn off green LED
    digitalWrite(D4, HIGH);             
  }else{
    digitalWrite(D0, HIGH); // Turn on green LED and turn off red LED
    digitalWrite(D4, LOW);
  }

  InfluxData row("data"); // Insert data to InfluxDB
  row.addTag("device", DEVICE_NAME);
  row.addTag("location", DEVICE_LOCATION);
  row.addValue("temperature", (float)DHT11.temperature);
  row.addValue("humidity", (float)DHT11.humidity);
  influx.write(row);
  
  delay(5000); // Delay 5 seconds
}
