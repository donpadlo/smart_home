<?php

# Исходный код Smart Home доступен по лицензии GPL3
# Используемые компоненты - по своим лицензиям
# Изначальный автор: Грибов Павел
# https://грибовы.рф

 $sql="select * from tasks";
 $stmt=$sqln->dbh->prepare($sql);
 $stmt->execute();
 $data = $stmt->fetchAll(PDO::FETCH_ASSOC);           
?>
<?php
foreach ($data as $task){
    $dtfrom=HumanDate($task["dtfrom"]);
    $dtto=HumanDate($task["dtto"]);
    $ds=TDevices::GetDeviceInfo($sqln, $task["device_source"]);
    echo "<p>С $dtfrom по $dtto если на тогда реле</p>";
}