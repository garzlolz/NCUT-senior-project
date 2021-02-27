<?php require '../../Connections/garzconn.php'?>
<?php
    $perpage = 7;
    $sql = "SELECT * FROM `arduino_db`.`temperature`  WHERE `t_time` LIKE '%12:00:0%' ORDER BY `t_time` DESC";
    $result = mysql_query($sql) ;
    $ttlrow = mysql_num_rows($result);
    $ttlpage = ceil($ttlrow/$perpage);
    while($arr = mysql_fetch_array($result))
    $data[]=$arr;
    /*while($row = mysql_fetch_array($result)){//印出資料 echo $row['t_sensor']." "."<br>";}*/
    
    if(empty($_GET['page'])|| !is_numeric($_GET['page'])||$_GET['page']<1||$_GET['page']>$ttlrow)
    $page=1;
    else
    $page = $_GET['page'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>過去7天</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    

    <!-- Bootstrap core CSS -->
   <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

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

      #btnprint{
        border-radius:10px;
        background-color:#3C3C3C;
        color:white;
      }

      #btnprint:hover{
        box-shadow:0px 0px 30px #7B7B7B	;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="http://172.20.10.7/arduino2/bootstrap/dashboard/7day.php">近期紀錄</a>
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
            <a class="nav-link" aria-current="page" href="../pricing/current.php">
              <span data-feather="home"></span>
              狀態更新
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="7day.php">
              <span data-feather="users"></span>
              近期紀錄
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="record.php">
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
        <h1 class="h2">過去的七天 <input type="button" id= "btnprint" value="列印本頁" onclick=Print()></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        <select name="forma" onchange="location = this.value;">
             <option value="7day.php">一個禮拜內</option>
             <option value="14day.php">兩個禮拜前</option>
             <option value="21day.php">三個禮拜前</option>
             <option value="whole.php">一個月內</option>
        </select>
        <form action="export/export7.php">
          <button type="submit" class="btn btn-sm btn-outline-secondary">匯出</button>
        </form>
        </div>
      </div>
      
      <canvas class="my-4 w-100" id="myChart" width="1000" height="400"></canvas>

      <h2>詳細</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>測量時間</th>
              <th>溫度</th>
              <th>濕氣</th>
              <th>空氣粉塵</th>
              
            </tr>
          </thead>
          <tbody>
           
          <?php
                for($i=0;$i<$perpage;$i++)
                {
                    $index = ($page-1)*$perpage+$i;
                    if($index>=count($data))break;
                    echo '<tr>';
                    //echo "<td>{$data[$index]['t_time']}</td>";
                    echo "<td>".date("Y F j, g:i a", strtotime($data[$index]['t_time']))."</td>";
                    echo "<td>{$data[$index]['t_temp']}°C</td>";
                    echo "<td>{$data[$index]['t_humidity']}%</td>";
                    echo "<td>{$data[$index]['t_sensor']} μg/m<sup>3</sup></td>";
                    
                    echo "</td>";
                }
          ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


    <script src="../../dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" 
      integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" 
      crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" 
      integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script>/* globals Chart:false, feather:false */
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
            for($i=$perpage-1;$i>=0;$i--)
            {
                $index = ($page-1) * $perpage + $i;
                if($index>=count($data))break;
                echo "'{$data[$index]['t_time']}'";
                echo ',';
            }
            ?>
      ],
      datasets: [{
          label:"空氣品質，單位 : μg/m³",
        data: [
            <?php
            for($i=$perpage-1;$i>=0;$i--)
            {
                $index = ($page-1) * $perpage + $i;
                if($index>=count($data))break;
                echo "'{$data[$index]['t_sensor']}'";
                echo ',';
            }       
            ?>
        ],
        lineTension: 0,
        backgroundColor: 'rgb(213,173,228,0.5)',
        borderColor: 'purple',
        borderWidth: 4,
        pointBackgroundColor: 'purple'
      },{
        label:"溫度，單位 : °C",
        data: [
            <?php
            for($i=$perpage-1;$i>=0;$i--)
            {
                $index = ($page-1) * $perpage + $i;
                if($index>=count($data))break;
                echo "'{$data[$index]['t_temp']}'";
                echo ',';
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
            for($i=$perpage-1;$i>=0;$i--)
            {
                $index = ($page-1) * $perpage + $i;
                if($index>=count($data))break;
                echo "'{$data[$index]['t_humidity']}'";
                echo ',';
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script>
  function Print() {
    window.print();
  }
</script>
  </body>
</html>
