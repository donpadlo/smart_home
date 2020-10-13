<?php

# Исходный код Smart Home доступен по лицензии GPL3
# Используемые компоненты - по своим лицензиям
# Изначальный автор: Грибов Павел
# https://грибовы.рф

class Tcfg {
    public $dbh;
    public $sitetitle;
    public function __construct($sqln) {
        $this->dbh=$sqln->dbh;
    }
    public function GetParam($paramname) {
      $stmt = $this->dbh->prepare("SELECT value FROM config WHERE `name` = ?");
      $stmt->execute([$paramname]);
      return $stmt->fetchColumn();
    }
    public function GetMainParam() {
        //var_dump($this->dbh);
        $this->sitetitle=$this->GetParam("sitetitle");
    }
}    
