<?php

# Исходный код Smart Home доступен по лицензии GPL3
# Используемые компоненты - по своим лицензиям
# Изначальный автор: Грибов Павел
# https://грибовы.рф

$debug=true;  // вывод на экран отладочной информации и информации об ошибках

$pdo_driver="mysql";
$pdo_username="smarthome";
$pdo_password="smarthome";
$pdo_basename="smarthome";

date_default_timezone_set('Europe/Moscow'); // Временная зона по умолчанию

// Если активен режим отладки, то показываем все ошибки и предупреждения
if ($debug) {
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
}