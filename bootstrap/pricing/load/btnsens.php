<?php require_once '../../../require.php';?>
<?
          if($row_rs['t_sensor']<=0)echo "Low Power";
          if($row_rs['t_sensor']<=75 && $row_rs['t_sensor']>0) echo "良好";
          if($row_rs['t_sensor']>75 and $row_rs['t_sensor']<=150) echo "普通";
          if($row_rs['t_sensor']>150 and $row_rs['t_sensor']<=300) echo "對敏感族群不健康<br>戴上口罩";
          if($row_rs['t_sensor']>300 and $row_rs['t_sensor']<=1050) echo "對所有族群不健康<br>開啟空氣清淨機";
          if($row_rs['t_sensor']>1050 and $row_rs['t_sensor']<=3000) echo "非常不健康<br>開啟空氣清淨機";
          if($row_rs['t_sensor']>3000 ) echo "危害<br>開啟空氣清淨機";
        ?>