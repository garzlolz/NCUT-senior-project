<!--______________________________________________________________________________________________________
  |______________________________________MYSQL CONNECT____________________________________________________|-->
<?php require_once '../require.php'?>
<!-----------------------------------------------------------------------------------------------------------
  |                                               HTML                                                       |    
  ___________________________________________________________________________________________________________-->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="10" >
        <title>即時檢測</title>
        <!------------------------------------JQ Mb----------->

        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
            <!--------------------------------------Jsc------------------>
            <scripts src="..scripts/jq.js"></scripts>
            <!------------------------------------------style-->
          <link rel="stylesheet" href="../garzstyle/current.css" type="text/css">     
    </head>
    <body>
        <div data-role="page" id="now">
            <!-------------------------面板------------------------------->
            <div data-role="panel" id="mypanel" data-display="reveal">
                <h1>更多...</h1>
               <a href="quality.php" class="ui-btn ui-icon-carat-r ui-btn-icon-bottom" id="rec"target="_self">數據紀錄</a>
               <a href="average.php" class="ui-btn ui-icon-carat-r ui-btn-icon-bottom" id="listv"target="_self">查看整個12月</a>
               <a href="chart.php" class="ui-btn ui-icon-carat-r ui-btn-icon-bottom" id="listv" target="_self">折線圖</a>
               <p>請將機器放置通風處<br>製作by 施宏勳&reg;</p>
            </div>
            <!--------------------------表頭------------------------------>
            <div data-role="header" id="hedd">
                    <a href="#mypanel" id="more" class="ui-btn ui-corner-all ui-icon-bars ui-btn-icon-left">更多</a>
                    <h1 id="hh1">溫溼度與空氣粉塵</h1>
            </div>
            <!--------------------------內容------------------------------>
            <div data-role="content" id="cont">
                <h1 style="text-align: center;">即時檢測</h1>

                <div class="ui-block-a">
                    <div id="bk1">
                        <h1>
                            空氣品質:<br>
                            <p id="sens"><?php echo $row_rs['t_sensor']?></p>μg/m3<br>
                            濕度:<?php echo $row_rs['t_humidity']; ?>%<br>
                            溫度:<?php echo $row_rs['t_temp']; ?>°C       
                        </h1>                      
                    </div>
                </div>
                <br>
                <div class="ui-block" id="bk2">
                    <a href="#" class="ui-btn ui-corner-all" id="advice">              
                      <strong id="testt">ERRORRR</strong>
                   </a>
                    <a href="#" class="ui-btn ui-corner-all" id="last">上次更新時間<?php echo $row_rs['t_time']?></a>
                 
                </div>
            </div>
            
            <!--------------------------頁尾------------------------------>
            <div data-role="footer" data-position="fixed" id="foot">
                <h1>@CopyRight by garz&reg;</h1>
            </div>
        </div>
        <script src="../scripts/current.js"></script>
    </body>
</html>
