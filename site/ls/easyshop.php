<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_easyshop = "127.0.0.1";
$database_easyshop = "arduino_db";
$username_easyshop = "root";
$password_easyshop = "root";
$easyshop = mysql_pconnect($hostname_easyshop, $username_easyshop, $password_easyshop) or trigger_error(mysql_error(),E_USER_ERROR);mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET UTF8");
?>