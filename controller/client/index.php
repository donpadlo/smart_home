<?php

# Исходный код Smart Home доступен по лицензии GPL3
# Используемые компоненты - по своим лицензиям
# Изначальный автор: Грибов Павел
# https://грибовы.рф

require_once 'service/header.php';

if ($user->id==0):
    $client="service/login";
endif;

require_once "$client.php";


require_once 'service/footer.php';