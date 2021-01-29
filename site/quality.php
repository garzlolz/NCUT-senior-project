<?php require_once '../require.php';?>
<!---------------------------------------------------HTML-------------------------------------------->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!----------------------------head--------------------->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>IOT溫溼度與PM2.5</title>

  <!---------------------------Jquery Mobile---------------------->
  <meta name="viewport" content="width-device-width,initial-scale=1">
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
  <!--style-->
    <link rel="stylesheet" href="../garzstyle/quality.css">
</head>
<!-------------------------------------Body----------------------->
<body>
<div data-role="page" id="page1">
      <a href="http://172.20.10.7/arduino2/site/current.php" class="ui-btn ui-icon-arrow-l ui-corner-all ui-btn-icon-left" id="rev" target="_self">返回目前狀態 &nbsp;&nbsp; 目前是
      <?php
        $nowpage = $pageNum_rs+1;
        if($nowpage==1)
        {
          echo "首頁";
        }
        else
        {
          echo "第";
          echo $nowpage;
          echo "頁";
        };
      ?></a>
  <table width="56%" border="1" align="center" bordercolor="#F9F9F9" data_role="table" class="ui-responsive" data-mode="columntoggle">
    <tr>
      <td colspan="4" bgcolor="#FFFFFF"><div align="center" id="tb1"><span class="style6">
      <img src="https://cp.cw1.tw/files/md5/34/fb/34fbc29b47c3ec61d62d7e24a37ce1cc-123923.jpg" width="328" height="171" /><br/>
      溫溼度&amp; PM2.5 </span> 
        <form id="form1" name="form1" method="get" action="quality.php">
          <label><span class="style7">日期搜尋
          </span>
          <input name="so" type="date" id="so" value="<?php echo date("Y-m");?>" />
          </label>
                <input type="submit" data-icon="check" data-iconpos="right" name="Submit" value="查詢" style="background-color:green"/>
        </form>
        </div></td>
    </tr>
      
    <tr>
      <th width="27%" bgcolor="#FFFFFF" ><div align="left" class="style10">時間⤵</div></th>
      <th width="33%" bgcolor="#FFFFFF" data-prority="3"><div align="left" class="style10">房間濕度</div></th>
      <th width="19%" bgcolor="#FFFFFF" data-prority="2"><div align="left" class="style10">房間溫度</div></th>
	    <th width="21%" bgcolor="#FFFFFF" data-prority="1"><div align="left" class="style10">PM2.5</div></th>
    </tr>

      <?php do {
	        if($row_rs['t_time']=="")exit;
	    ?>
      <tr id="conttt">
        <td><div align="left" class="style7"><?php echo date("F j, Y g:i a", strtotime($row_rs["t_time"])); ?></div></td>
        <td><div align="left" class="style7"><?php echo $row_rs['t_humidity']; ?>%</div></td>
        <td><div align="left" class="style7"><?php echo $row_rs['t_temp']; ?>℃</div></td>
        <td><div align="left" class="style7"><?php echo $row_rs['t_sensor']; ?><br>[
        <?
		
    		/*
        3000 + = 危害
       1050-3000 = 非常不健康
        300-1050 = 對所有族群不健康
        150-300 = 對敏感族群不健康
        75-150 = 普通
        0-75 = 良好
       */
       if($row_rs['t_sensor']<=0)echo "<font color=red>Low Power</font>";
       if($row_rs['t_sensor']<=75 && $row_rs['t_sensor']>0) echo "<font color=#629123>良好</font>";
       if($row_rs['t_sensor']>75 and $row_rs['t_sensor']<=150) echo "<font color=#B3B334>普通</font>";
       if($row_rs['t_sensor']>150 and $row_rs['t_sensor']<=300) echo "<font color=#FFB95D>對敏感族群不健康</font>";
       if($row_rs['t_sensor']>300 and $row_rs['t_sensor']<=1050) echo "<font color=#B02525>對所有族群不健康</font>";
       if($row_rs['t_sensor']>1050 and $row_rs['t_sensor']<=3000) echo "<font color=#AF34B3>非常不健康</font>";
       if($row_rs['t_sensor']>3000 ) echo "<font color=#570606>危害<font>";
 
		
      ?>]

    </div>
  </td>
      </tr>
      <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
  </table>
    <br/><br/><hr/>

    <div data-role="footer" data-position="fixed" id="foot">
      <table border="0" width="70%" align="center" id="tb3">
      <tr>
        <td width="23%" align="center"><div align="left" class="style9">
          <?php if ($pageNum_rs > 0) { // Show if not first page ?>
            <span class="style7"><span class="style5"><a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, 0, $queryString_rs); ?>" class="ui-btn ui-corner-all ui-icon-home ui-btn-icon-left">首頁</a>
              <?php } // Show if not first page ?>
        </span></span></div></td>
        <td width="31%" align="center"><div align="left" class="style9">
          <?php if ($pageNum_rs > 0) { // Show if not first page ?>
            <span class="style7"><span class="style5"><a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, max(0, $pageNum_rs - 1), $queryString_rs); ?>" class="ui-btn ui-corner-all ui-icon-arrow-l ui-btn-icon-left">前一頁</a>
              <?php } // Show if not first page ?>
        </span></span></div></td>
        <td width="23%" align="center"><div align="left" class="style9">
          <?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
            <span class="style7"><span class="style5"><a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, min($totalPages_rs, $pageNum_rs + 1), $queryString_rs); ?>" class="ui-btn ui-corner-all ui-icon-arrow-r ui-btn-icon-left">下一頁</a>
              <?php } // Show if not last page ?>
        </span></span></div></td>
        <td width="23%" align="center"><div align="left" class="style9">
         <?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
            <span class="style7"><span class="style5"><a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, $totalPages_rs, $queryString_rs); ?>" class="ui-btn ui-corner-all ui-icon-carat-r ui-btn-icon-left">最後一頁</a>
              <?php } // Show if not last page ?>
        </span></span></div></td>
        </tr>
      </table>
    </div>

</div>
</body>
</html>
<?php
mysql_free_result($rs);
?>
