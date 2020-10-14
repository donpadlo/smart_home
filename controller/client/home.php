<?php

# Исходный код Smart Home доступен по лицензии GPL3
# Используемые компоненты - по своим лицензиям
# Изначальный автор: Грибов Павел
# https://грибовы.рф

// рисую группы из таблицы groups
?>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-fluid-5">
<?php
 $sql="select * from groups";
 $stmt=$sqln->dbh->prepare($sql);
 $stmt->execute();
 $data = $stmt->fetchAll(PDO::FETCH_ASSOC);           
 foreach ($data as $groups){
  $groupid=$groups["id"];
?>
  <div class="col mb-4">
    <div class="card">
      <div class="view overlay">
        <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/16.jpg" alt="Card image cap">
        <a href="#!">
          <div class="mask rgba-white-slight"></div>
        </a>
      </div>
      <div class="card-body">
        <h4 class="card-title"><?= $groups["name"] ?></h4>
        <p class="card-text">
          <?php
            // листаем все устройства в этой группе
            $sql="select * from group_staff where groupid=$groupid";            
            $stmt2=$sqln->dbh->prepare($sql);
            $stmt2->execute();
            $data = $stmt2->fetchAll(PDO::FETCH_ASSOC);           
            foreach ($data as $group_staff){
                $device=$group_staff["device"];
                $device_info=TDevices::GetDeviceInfo($sqln,$device);
                ?>
                 <span title="<?= $device_info["comment"];?>"class="badge badge-secondary"><?= $device_info["name"];?></span>
                <?php                
                // вывожу все последние значения этих устройств
                $sql="select * from data_types";
                $stmt4=$sqln->dbh->prepare($sql);
                $stmt4->execute();
                $data = $stmt4->fetchAll(PDO::FETCH_ASSOC);           
                foreach ($data as $dtids){
                    $sql="select storage.dt,storage.value,data_types.id as dtype,data_types.name as dname,data_types.comment as dcomment from storage inner join data_types on data_types.id=storage.datatype where storage.device=$device and data_types.id=".$dtids["id"]." order by storage.id desc limit 1";
                    $stmt3=$sqln->dbh->prepare($sql);
                    $stmt3->execute();
                    $data = $stmt3->fetchAll(PDO::FETCH_ASSOC);           
                    foreach ($data as $storage){
                        // если сенсоры
                        if (in_array($storage["dtype"],$sensors_array)):
                            echo "<p>".$storage["value"].$storage["dname"]."</p>";
                        endif;
                        // если реле
                        if (in_array($storage["dtype"],$rele_array)):
                            if ($storage["value"]=="off"):
                                ?>
                                    <div class="col-sm-5">
                                    <button type="button" class="btn btn-lg btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off">
                                      <div class="handle"></div>
                                    </button>
                                  </div>                                
                                <?php
                            else:
                                ?>
                                    <div class="col-sm-5">
                                    <button type="button" class="btn btn-lg btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off">
                                      <div class="handle"></div>
                                    </button>
                                  </div>                                
                                <?php                                
                            endif;
                        endif;

                    };                                    
                };
                
            };            
          ?>
        </p>        
      </div>
    </div>    
  </div>
 <?php
};
?>
</div>