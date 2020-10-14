<?php

# Исходный код Smart Home доступен по лицензии GPL3
# Используемые компоненты - по своим лицензиям
# Изначальный автор: Грибов Павел
# https://грибовы.рф
class TDevices {
    public static function GetDeviceInfo($sqln,$device) {            
        $device_info["name"]="";
        $device_info["comment"]="";
        $sql="select * from devices where id=$device";        
        $stmt3=$sqln->dbh->prepare($sql);
        $stmt3->execute();
        $data = $stmt3->fetchAll(PDO::FETCH_ASSOC);           
        foreach ($data as $dev){
            $device_info["name"]=$dev["name"];
            $device_info["comment"]=$dev["name"];
        }; 
        return $device_info;
    }
} 