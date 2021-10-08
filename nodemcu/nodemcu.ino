/*
 * Hybrid-IoT NodeMCU Source Code
 * Coded by Taewon Kim
 */

#include <LiquidCrystal_I2C.h>
#include <dht11.h>

LiquidCrystal_I2C lcd(0x27, D1, D2);
dht11 DHT11;

void setup()
{
  Serial.begin(115200); // Set boardrate to 115200

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
  
  delay(5000); // Delay 5 seconds
}
