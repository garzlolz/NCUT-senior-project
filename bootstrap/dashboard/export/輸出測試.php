<?php 
include '../../../Connections/garzconn.php';
$xls_filename = 'db_export_'.date('Y-m-d H:i:s').".xls";
mysql_query("set names 'UTF-8'");
header('Content-type: text/html; charset=utf-8');
header("Content-type:application/vnd.ms-excel;charset=UTF-8"); 
header("Content-Disposition:filename=".$xls_filename."");
$sql="SELECT * FROM `arduino_db`.`temperature` WHERE `t_time` LIKE '%12:00:0%' ORDER BY `t_time` DESC LIMIT 0,30";
$result=mysql_query($sql);
echo "Time\tHumidity\tTemp\tPM2.5\n";
while($row=mysql_fetch_array($result)){
echo $row[3]."\t".$row[1]."\t".$row[2]."\t".$row[4]."\t"."\n";
}
exit;
?>