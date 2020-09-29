<?php

# Исходный код Smart Home доступен по лицензии GPL3
# Используемые компоненты - по своим лицензиям
# Изначальный автор: Грибов Павел
# https://грибовы.рф

define('WUO_ROOT', dirname(__FILE__));

$time_start = microtime(true); // Засекаем время начала выполнения скрипта

header('Content-Type: text/html; charset=utf-8');

require_once WUO_ROOT.'/../config.php';  // основные настройки
require_once WUO_ROOT.'/../vendor/autoload.php';

require_once WUO_ROOT.'/../class/pdo_connect.php'; // соединяемся с БД