<?php

# Исходный код Smart Home доступен по лицензии GPL3
# Используемые компоненты - по своим лицензиям
# Изначальный автор: Грибов Павел
# https://грибовы.рф
class Tcfg {
    public $dbh;
    public function __construct($dbh) {
        $this->dbh=$dbh;
    }
    public function GetParam($paramname) {
      $stmt = $this->dbh->prepare("SELECT * FROM config WHERE `valuename` = ?");
      $stmt->execute([$paramname]);
      return $stmt->fetch(PDO::FETCH_LAZY);
    }
}    