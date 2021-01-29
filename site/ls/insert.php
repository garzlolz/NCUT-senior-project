<?php

 require_once('Connections/easyshop.php');  
 
 $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+8 , date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
 
 
mysql_select_db($database_easyshop, $easyshop);
$query_rs = "insert into temperature (t_sensor,t_time,t_temp,t_humidity) values('".$_GET['num3']."','".$datetime."','".$_GET['num']."','".$_GET['num2']."')";
$rs = mysql_query($query_rs, $easyshop) or die(mysql_error());
 
 
?>