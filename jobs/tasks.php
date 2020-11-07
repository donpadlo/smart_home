#!/usr/bin/php
<?php

# Исходный код Smart Home доступен по лицензии GPL3
# Используемые компоненты - по своим лицензиям
# Изначальный автор: Грибов Павел
# https://грибовы.рф

// Проверяем, а вдруг мы уже запущены?
 $fl = fopen("/tmp/tasks.lock", "w"); 
 if( ! ( $fl && flock( $fl, LOCK_EX | LOCK_NB ) ) ) {
    die("--копия скрипта уже запущена!");   
 };

define('WUO_ROOT', dirname(__FILE__));
require_once WUO_ROOT.'/../config.php';             // основные настройки
require_once WUO_ROOT.'/../inc/functions.php';          // основные функции
require_once WUO_ROOT.'/../vendor/autoload.php';
// загружаем классы
spl_autoload_register(function ($class_name) {
    require_once WUO_ROOT.'/../class/'.$class_name.'.php';
});

require_once WUO_ROOT.'/../inc/main.php';          // подготавливаемся к старту

$sql="select tasks.*,actions.name as asw from tasks inner join actions on actions.id=tasks.action where now() between dtfrom and dtto and active=1";
$stmt3=$sqln->dbh->prepare($sql);
$stmt3->execute();
$data = $stmt3->fetchAll(PDO::FETCH_ASSOC);           
foreach ($data as $task){  
    $datadev= TDevices::GetLastStorageValue($sqln, $task["device_source"], $task["datatype"]);
    $targetdev= TDevices::GetDeviceInfo($sqln, $task["device_target"]);
    //var_dump($targetdev);
    if ($datadev["timeout"]>$cfg->timeout){
      echo "--опрос датчика был слишком давно. Пропускаю..";  
    } else {
        if ($task["condition"]==">"):
          if ($datadev["value"]>$task["value"]):
            echo $datadev["value"].">".$task["value"]."\n";  
            SonoffSW($targetdev,$task["asw"]);
          endif;
        endif;
        if ($task["condition"]=="<"):
          if ($datadev["value"]<$task["value"]):
            echo $datadev["value"]."<".$task["value"]."\n";
            SonoffSW($targetdev,$task["asw"]);
          endif;
        endif;        
    };
};    

function SonoffSW($dev_info,$mode){
        $url = "http://".$dev_info["IP"].":8081/zeroconf/switch";
        echo "$url\n";
        $post_data = '{"deviceid": "'.$dev_info["deviceid"].'","data": { "switch": "'.$mode.'"}}';
        echo "$post_data\n";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);      
        $res=curl_exec($ch);
        curl_close($ch);
        echo "$res\n";           
};