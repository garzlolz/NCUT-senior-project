<?php require_once('Connections/easyshop.php'); ?>
<?php
mysql_select_db($database_easyshop, $easyshop);
$query_del = "delete FROM temperature";
$del = mysql_query($query_del, $easyshop) or die(mysql_error());
 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
</body>
</html>
 