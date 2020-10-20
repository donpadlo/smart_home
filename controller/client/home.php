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
 $cnt=0;
 foreach ($data as $groups){
  $groupid=$groups["id"];
  $photofile=$groups["photofile"];
?>
  <div class="col mb-4">
    <div class="card">
      <div class="view overlay">
        <img class="card-img-top" src="/images/<?=$photofile?>" alt="Фото объекта">
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
                $cnt++;
                $device=$group_staff["device"];
                $device_info=TDevices::GetDeviceInfo($sqln,$device);
                echo '<span title="'.$device_info["comment"].'"class="badge badge-secondary">'.$device_info["name"].'</span>';                
                // вывожу все последние значения этих устройств
                $sql="select * from data_types";
                $stmt4=$sqln->dbh->prepare($sql);
                $stmt4->execute();
                $data = $stmt4->fetchAll(PDO::FETCH_ASSOC);           
                foreach ($data as $dtids){                    
                    $cnt++;
                    $dttypeid=$dtids["id"];
                    $sql="select storage.dt,storage.value,data_types.id as dtype,data_types.name as dname,data_types.comment as dcomment from storage inner join data_types on data_types.id=storage.datatype where storage.device=$device and data_types.id=".$dtids["id"]." order by storage.id desc limit 1";
                    //echo "$sql";
                    $stmt3=$sqln->dbh->prepare($sql);
                    $stmt3->execute();
                    $data = $stmt3->fetchAll(PDO::FETCH_ASSOC);           
                    foreach ($data as $storage){
                        $cnt++;
                        // если сенсоры
                        if (in_array($storage["dtype"],$sensors_array)):                            
                            echo "<div id='sensordiv$cnt' class='sensorsdataview'>".$storage["value"].$storage["dname"]."</div>";
                            echo "<script>timerId = setInterval(() => UpdateSensor('sensordiv$cnt',$device,$dttypeid), ".$cfg->refreshtime.");</script>";
                        endif;
                        // если реле
                        if (in_array($storage["dtype"],$rele_array)):
                            $active="checked";
                            if ($storage["value"]=="off"):$active="";endif;
                                ?>
                                <div class='reledataview'>
                                    <input  namwe='sensordiv<?=$cnt?>' id='sensordiv<?=$cnt?>' class="form-check-input" type="checkbox" data-toggle="toggle" <?=$active?>>
                                </div>       
                                <script> 
                                    $('#sensordiv<?=$cnt?>').change(function() {
                                        ChangeRele('sensordiv<?=$cnt?>',<?=$device?>);
                                    });                                     
                                    timerId = setInterval(() => UpdateRele('sensordiv<?=$cnt?>',<?=$device?>,<?=$dttypeid?>),<?=$cfg->refreshtime?>);
                                </script>
                               <?php
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
<script>
function ChangeRele(relediv,device){
   console.log(relediv,device);
    $.get("/server/common/setReleOffOn&device="+device+"&status="+$("#"+relediv).is(":checked"), function(data) {       
      console.log(data);
    });
   
};
function UpdateSensor(divid,device,dttypeid){
  console.log("S",divid,device,dttypeid);  
  //$("#"+divid).load("/server/common/getvaluesensor&device="+device+"&datatype="+dttypeid);
    $.get("/server/common/getvaluesensor&device="+device+"&datatype="+dttypeid, function(data) {
        data=JSON.parse(data);
        if (data.timeout><?=$cfg->timeout?>){
            $('#'+divid).html("Не опрашивается");
        } else {
            $('#'+divid).html(data.value+data.dname);
        };
       // console.log(data);
    });
  
};
function UpdateRele(divid,device,dttypeid){
    console.log("R",divid,device,dttypeid);  
    $.get("/server/common/getvaluerele&device="+device+"&datatype="+dttypeid, function(data) {
        data=JSON.parse(data);
        if (data.timeout><?=$cfg->timeout?>){
           // $('#'+divid).bootstrapToggle('disable');
        } else {
//            $('#'+divid).bootstrapToggle('enable');
//            if (data.value=="on"){
//                $('#'+divid).bootstrapToggle('on');
//            } else {
//                $('#'+divid).bootstrapToggle('off');              
//            };
           // console.log(data);
        };
    });
  
};

</script>    