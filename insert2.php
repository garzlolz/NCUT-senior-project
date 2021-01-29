<?php

 require_once('Connections/garzconn.php');  
 
 $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+8 , date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
 
 
mysql_select_db($database_garz, $garz);
if($_GET['num3']>1){
$query_rs = "insert into temperature (t_sensor,t_time,t_temp,t_humidity) values('".$_GET['num3']."','".$datetime."','".$_GET['num2']."','".$_GET['num']."')";
$rs = mysql_query($query_rs, $garz) or die(mysql_error());
}
 
?>