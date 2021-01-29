<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_garz = "127.0.0.1";
$database_garz = "arduino_db";
$username_garz = "root";
$password_garz = "root";
$garz = mysql_pconnect($hostname_garz, $username_garz, $password_garz) or trigger_error(mysql_error(),E_USER_ERROR);mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET UTF8");
?>