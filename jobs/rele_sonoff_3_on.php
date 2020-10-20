<?php

# Исходный код Smart Home доступен по лицензии GPL3
# Используемые компоненты - по своим лицензиям
# Изначальный автор: Грибов Павел
# https://грибовы.рф

define('WUO_ROOT', dirname(__FILE__));
require_once WUO_ROOT.'/../config.php';             // основные настройки
require_once WUO_ROOT.'/../inc/functions.php';          // основные функции
require_once WUO_ROOT.'/../vendor/autoload.php';
// загружаем классы
spl_autoload_register(function ($class_name) {
    require_once WUO_ROOT.'/../class/'.$class_name.'.php';
});

require_once WUO_ROOT.'/../inc/main.php';          // подготавливаемся к старту

$sql="select * from devices where devicemodel=2";

$stmt3=$sqln->dbh->prepare($sql);
$stmt3->execute();
$data = $stmt3->fetchAll(PDO::FETCH_ASSOC);           
foreach ($data as $dev){  
    $device_id=$dev["id"];
    $dev_info=TDevices::GetDeviceInfo($sqln, $dev["id"]);
    if (isset($dev_info["IP"])):
        $url = "http://".$dev_info["IP"].":8081/zeroconf/switch";
        echo "$url\n";
        $post_data = '{"deviceid": "'.$dev_info["deviceid"].'","data": { "switch": "on"}}';
        echo "$post_data\n";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);      
        $res=curl_exec($ch);
        curl_close($ch);
        echo "$res\n";       
        
    endif;
};