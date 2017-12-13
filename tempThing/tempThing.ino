//Include da biblioteca das placas Esp
#include <ESP8266WiFi.h> 
#include <SPI.h>
#include <SD.h>

//Include da lib do sensor DHT11 e DHT22
#include "DHT.h"

//Definir o SSID da rede WiFi
const char* ssid = "GXXXXXX";  //nome da rede
const char* password = "123"; // senha da rede
 
//Define do pino a ser utilizado no ESP para o sensor = D7
#define DHT_DATA_PIN 13
#define DHTTYPE DHT11

 
//Colocar a API Key para escrita neste campo
//Ela é fornecida no canal que foi criado na aba API Keys
String apiKeyE = "PA4XARU64ERAGXYI";
const char* server = "api.thingspeak.com";
File myFile;
 
DHT dht(DHT_DATA_PIN, DHTTYPE);
WiFiClient client;
 
void setup() {
  //Configuração da UART/USB para escita e leitura de dados no monitor
  Serial.begin(9600);
  while (!Serial) {
    ; // wait for serial port to connect. Needed for native USB port only
  }
  dht.begin();
  Serial.print("Sensor iniciado");

  Serial.println("iniciando SD...");
  while (!SD.begin(4)) {
    Serial.println("inicializacao do SD falida!");
    while (1);
  }
  Serial.println("SD inicializado.");

  Serial.println("Criando examplo.txt...");
  myFile = SD.open("exemplo.txt", FILE_WRITE);
  myFile.println("testing 1, 2, 3.");
  //Inicia o WiFi
  //WiFi.begin(ssid, password);
 
  //Espera a conexão
  //enquanto não conecta ele vai imprimir . a cada meio segundo 
  /*while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connectedo!");
 
  
 
  //Logs na porta serial
  Serial.println("");
  Serial.print("Conectado na rede ");
  Serial.println(ssid);
  Serial.print("IP: ");
  Serial.println(WiFi.localIP());*/
}
 
void loop() {
 
  //Espera 20 segundos para fazer a leitura
  delay(20000);
  //Leitura de umidade
  float umidade = dht.readHumidity();
  //Leitura de temperatura
  float temperatura = dht.readTemperature();
 
  //Se não for um numero retorna erro de leitura
  if (isnan(umidade) || isnan(temperatura)) {
    Serial.println("Erro ao ler o sensor!");
    return;
  }

  Serial.print("Temperatura: ");
  Serial.print(temperatura);
  Serial.print(" Umidade: ");
  Serial.println(umidade);
 
  //Inicia um client TCP para o envio dos dados
//  if (client.connect(server,80)) {
//    String postStr = apiKeyE;
//           postStr +="&amp;field1=";
//           postStr += String(temperatura);
//           postStr +="&amp;field2=";
//           postStr += String(umidade);
//           postStr += "\r\n\r\n";
// 
//     client.print("POST /update HTTP/1.1\n");
//     client.print("Host: api.thingspeak.com\n");
//     client.print("Connection: close\n");
//     client.print("X-THINGSPEAKAPIKEY: "+apiKeyE+"\n");
//     client.print("Content-Type: application/x-www-form-urlencoded\n");
//     client.print("Content-Length: ");
//     client.print(postStr.length());
//     client.print("\n\n");
//     client.print(postStr);
 
     //Logs na porta serial
     
  //}
  //client.stop();
}
