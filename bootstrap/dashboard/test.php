<?php include('../../Connections/garzconn.php');
  $currentPage = $_SERVER["PHP_SELF"];
  $maxRows_rs = 7;
  $pageNum_rs = 0;
  
  if (isset($_GET['pageNum_rs'])) {
     $pageNum_rs = $_GET['pageNum_rs'];
  }

  $startRow_rs = $pageNum_rs * $maxRows_rs;

//SELECT DB

  mysql_select_db($database_garz, $garz);
  if($_GET['so']==""){
  $query_rs = "SELECT * FROM temperature WHERE `t_time` like '%:00:0%' ORDER BY t_time DESC";
  }else{
  $query_rs = "SELECT * FROM temperature where t_time like '%".$_GET['so']."%' AND(`t_time` LIKE '%:00:0%') ORDER BY t_time DESC";
  }
  
  $query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);
  $rs = mysql_query($query_limit_rs, $garz) or die(mysql_error());
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
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>搜索日期</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href="../../dist/css/bootstrap.min.css" rel="stylesheet" alt = "error" >

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="http://172.20.10.7/arduino2/bootstrap/dashboard/record.php">搜索日期</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
      <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="http://172.20.10.7/arduino2/bootstrap/pricing/current.php">
              <span data-feather="home"></span>
              狀態更新
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="7day.php">
              <span data-feather="users"></span>
              近期紀錄
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link  active" href="record.php">
              <span data-feather="bar-chart-2"></span>
              搜索日期
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>請將機器放置通風處</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">折線圖</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        <form action="export/extest.php">
          <button type="submit" class="btn btn-sm btn-outline-secondary">Export</button>
        </form>
        </div>
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

      <h2>搜索日期</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
    <tr><td colspan="4" bgcolor="#FFFFFF"><div align="center" id="tb1"><span class="style6"><br/>
      溫溼度&amp; PM2.5 </span> 
        <form id="form1" name="form1" method="get" action="test.php" alt="error">
          <label><span class="style7">日期搜尋
          </span>
          <input name="so" type="date" id="so" value="<?php echo date("Y-m");?>" />
          </label>
                <input type="submit" data-icon="check" data-iconpos="right" name="Submit" value="查詢"/>
        </form>
        </div></td>
    </tr>
      
    <tr>
      <th>測量時間</th>
      <th>濕度</th>
      <th>溫度</th>
	  <th>PM2.5</th>
    </tr>

      <?php do {
	        if($row_rs['t_time']=="")exit;
	    ?>
      <tr>
        <td><div><?php $timedata[]="'".$row_rs["t_time"]."'";    echo date("Y F j, g:i a", strtotime($row_rs["t_time"])); ?></div></td>
        <td><div><?php $humdata[]="'".$row_rs["t_humidity"]."'"; echo $row_rs['t_humidity']; ?>%</div></td>
        <td><div><?php $tempdata[]="'".$row_rs["t_temp"]."'";    echo $row_rs['t_temp']; ?>℃</div></td>
        <td><div><?php $sensdata[]="'".$row_rs["t_sensor"]."'";  echo $row_rs['t_sensor']." μg/m<sup>3</sup>"; ?><br>
        [
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
       if($row_rs['t_sensor']>150 and $row_rs['t_sensor']<=300) echo "<font color=red>對敏感族群不健康</font>";
       if($row_rs['t_sensor']>300 and $row_rs['t_sensor']<=1050) echo "<font color=#B02525>對所有族群不健康</font>";
       if($row_rs['t_sensor']>1050 and $row_rs['t_sensor']<=3000) echo "<font color=#AF34B3>非常不健康</font>";
       if($row_rs['t_sensor']>3000 ) echo "<font color=#570606>危害<font>";
 
		
      ?>]
      
    </div>
  </td>
      </tr>
      <?php $data[]=$row_rs; } while ($row_rs = mysql_fetch_assoc($rs)); ?>
  </table>
    <br/><br/>
    <hr/>

    <div data-role="footer" data-position="fixed" id="foot">
      <table class="table table-striped table-sm">
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
    </main>
  </div>
</div>


    <script src="../../dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
      <script>
 (function () {
  'use strict'

  feather.replace()

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        <?php 
          for($i=$maxRows_rs-1;$i>=0;$i--)
          {
            echo $timedata[$i].",";
          }
        ?>
      ],
      datasets: [{
        label:"空氣品質，單位 : μg/m³",
        data: [
          <?php 
          for($i=$maxRows_rs-1;$i>=0;$i--)
          {
            echo $sensdata[$i].",";
          }
        ?>
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: 'purple',
        borderWidth: 4,
        pointBackgroundColor: 'purple'
      },
      {
        label:"溫度，單位 : °C",
        data: [
          <?php 
          for($i=$maxRows_rs-1;$i>=0;$i--)
          {
            echo $tempdata[$i].",";
          }
        ?>
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: 'green',
        borderWidth: 4,
        pointBackgroundColor: 'green'
      },{
        label:"濕氣，單位 : %",
        data: [
          <?php 
          for($i=$maxRows_rs-1;$i>=0;$i--)
          {
            echo $humdata[$i].",";
          }
        ?>
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: true
      }
    }
  })
})()
      </script>
  </body>
</html>
<?php
mysql_free_result($rs);
?>