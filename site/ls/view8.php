<?php require_once('Connections/easyshop.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs = 50;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

mysql_select_db($database_easyshop, $easyshop);
if($_GET['so']==""){
$query_rs = "SELECT * FROM temperature ORDER BY t_id DESC";
}else{
$query_rs = "SELECT * FROM temperature where t_time like '%".$_GET['so']."%' ORDER BY t_id DESC";
}

$query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);
$rs = mysql_query($query_limit_rs, $easyshop) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);

if (isset($_GET['totalRows_rs'])) {
  $totalRows_rs = $_GET['totalRows_rs'];
} else {
  $all_rs = mysql_query($query_rs);
  $totalRows_rs = mysql_num_rows($all_rs);
}
$totalPages_rs = ceil($totalRows_rs/$maxRows_rs)-1;

$queryString_rs = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs") == false && 
        stristr($param, "totalRows_rs") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs = sprintf("&totalRows_rs=%d%s", $totalRows_rs, $queryString_rs);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="5" >
<title>IOT溫溼度與PM2.5</title>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style6 {font-size: 20px}
.style7 {font-size: 14px}
body {
	/*background-image: url(bg.jpg);*/
  background-color:aqua;
}
.style9 {font-size: 14; }
.style10 {font-size: 14px; color: #000000; }
-->
</style>
<meta http-equiv="Refresh" content="10000" />
</head>

<body>
<div align="center" class="style1">
  <table width="56%" border="1" align="center" bordercolor="#F9F9F9">
    <tr>
      <td colspan="4" bgcolor="#FFFFFF"><div align="center"><span class="style6"><img src="https://cp.cw1.tw/files/md5/34/fb/34fbc29b47c3ec61d62d7e24a37ce1cc-123923.jpg" width="328" height="171" /><br />
      溫溼度&amp; PM2.5 </span> 
        <form id="form1" name="form1" method="get" action="view8.php">
          <label><span class="style7">日期搜尋
          </span>
          <input name="so" type="text" id="so" value="<?php echo date("Y-m");?>" size="12" />
          </label>
                <label>
                <input type="submit" name="Submit" value="送出" />
            </label>
        </form>
        </div></td>
    </tr>
    <tr>
      <td width="27%" bgcolor="#FFFFFF"><div align="left" class="style10">時間</div></td>
      <td width="33%" bgcolor="#FFFFFF"><div align="left" class="style10">溫度</div></td>
      <td width="19%" bgcolor="#FFFFFF"><div align="left" class="style10"> 濕度 </div></td>
	  <td width="21%" bgcolor="#FFFFFF"><div align="left" class="style10">PM2.5</div></td>
    </tr>
    <?php do {
	if($row_rs['t_time']=="")exit;
	 ?>
      <tr>
        <td bgcolor="#FFFFFF"><div align="left" class="style7"><?php echo $row_rs['t_time']; ?></div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style7"><?php echo $row_rs['t_humidity']; ?>度</div></td>
        <td bgcolor="#FFFFFF"><div align="left" class="style7"><?php echo $row_rs['t_temp']; ?>%</div></td>
		<td bgcolor="#FFFFFF"><div align="left" class="style7"><?php echo $row_rs['t_sensor']; ?>[<?
		
		/*
3000 + = 很差
1050-3000 = 差
300-1050 = 一般
150-300 = 好
75-150 = 很好
0-75 = 非常好
 */
 if($row_rs['t_sensor']<=75) echo "<font color=#629123>良好</font>";
 if($row_rs['t_sensor']>75 and $row_rs['t_sensor']<=150) echo "<font color=#B3B334>普通</font>";
 if($row_rs['t_sensor']>150 and $row_rs['t_sensor']<=300) echo "<font color=#FFB95D>對敏感族群不健康</font>";
  if($row_rs['t_sensor']>300 and $row_rs['t_sensor']<=1050) echo "<font color=#B02525>對所有族群不健康</font>";
   if($row_rs['t_sensor']>1050 and $row_rs['t_sensor']<=3000) echo "<font color=#AF34B3>非常不健康</font>";
    if($row_rs['t_sensor']>3000 ) echo "<font color=#570606>危害<font>";
 
		
		?>]</div></td>
      </tr>
      <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
  </table>

  <br />
  <br />
  <hr />
  <table border="0" width="70%" align="center">
    <tr>
      <td width="23%" align="center" bgcolor="#FFFFFF"><div align="left" class="style9">
        <?php if ($pageNum_rs > 0) { // Show if not first page ?>
          <span class="style7"><span class="style5"><a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, 0, $queryString_rs); ?>">回到第一頁</a>
            <?php } // Show if not first page ?>
      </span></span></div></td>
      <td width="31%" align="center" bgcolor="#FFFFFF"><div align="left" class="style9">
        <?php if ($pageNum_rs > 0) { // Show if not first page ?>
          <span class="style7"><span class="style5"><a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, max(0, $pageNum_rs - 1), $queryString_rs); ?>">前一頁</a>
            <?php } // Show if not first page ?>
      </span></span></div></td>
      <td width="23%" align="center" bgcolor="#FFFFFF"><div align="left" class="style9">
        <?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
          <span class="style7"><span class="style5"><a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, min($totalPages_rs, $pageNum_rs + 1), $queryString_rs); ?>">下一頁</a>
            <?php } // Show if not last page ?>
      </span></span></div></td>
      <td width="23%" align="center" bgcolor="#FFFFFF"><div align="left" class="style9">
        <?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
          <span class="style7"><span class="style5"><a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, $totalPages_rs, $queryString_rs); ?>">最後一頁</a>
            <?php } // Show if not last page ?>
      </span></span></div></td>
    </tr>
  </table>
</div>
</body>
</html>
<?php
mysql_free_result($rs);
?>
