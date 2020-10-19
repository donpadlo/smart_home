<?php

# Исходный код Smart Home доступен по лицензии GPL3
# Используемые компоненты - по своим лицензиям
# Изначальный автор: Грибов Павел
# https://грибовы.рф

$device= _GET("device");
$datatype=_GET("datatype");

$storage= TDevices::GetLastStorageValue($sqln, $device, $datatype);
echo json_encode($storage);