#!/usr/bin/python3
# coding=utf-8
import mysql.connector
from mysql.connector import Error
import dh11
import RPi.GPIO as GPIO
import time

try:
    conn = mysql.connector.connect(host="188.93.210.159",database="malgino",user="donpadlo",password="padlozapadlo")	
    if conn.is_connected(): print('--cоединение с БД  установлено')
except Error as e:
    print("Ошибка: ",e);
    exit(1); 
Temp_sensor=14
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)      
instance = dh11.DHT11(pin = Temp_sensor)
result = instance.read()
if result.is_valid(): 
      sql="insert into storage (id,dt,device,datatype,value) values (null,now(),1,1,'"+str((result.temperature))+"')";
      cursor = conn.cursor()
      cursor.execute(sql);
      conn.commit();
      sql="insert into storage (id,dt,device,datatype,value) values (null,now(),1,2,'"+str((result.humidity))+"')";
      #sql="insert into sensors_data (id,sensor_id,dt,value) values (null,2,now(),'"+str((result.humidity))+"')";
      cursor = conn.cursor()
      cursor.execute(sql);
      conn.commit();      
      print(str(result.temperature)+" C")
      print(str(result.humidity)+"%")