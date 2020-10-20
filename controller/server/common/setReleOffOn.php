<?php

# Исходный код Smart Home доступен по лицензии GPL3
# Используемые компоненты - по своим лицензиям
# Изначальный автор: Грибов Павел
# https://грибовы.рф

$device= _GET("device");
$status= _GET("status");

    $dev_info=TDevices::GetDeviceInfo($sqln, $device);
    if (isset($dev_info["IP"])):
        if ($status=="true"){$status="on";} else {$status="off";};
        $sql="insert into shedule (id,device,action) values (null,$device,'$status')";
        $stmt3=$sqln->dbh->prepare($sql);
        $stmt3->execute();        
//        if ($status=="true"){$status="on";} else {$status="off";};
//        $url = "http://".$dev_info["IP"].":8081/zeroconf/switch";
//        echo "$url\n";
//        $post_data = '{"deviceid": "'.$dev_info["deviceid"].'","data": {"switch": "'.$status.'"}}';
//        echo "$post_data\n";
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);      
//        $res=curl_exec($ch);
//        curl_close($ch);
//        echo "$res\n";
        
    endif;