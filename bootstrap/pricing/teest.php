<?php require_once '../../require.php';?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>PM2.5、溫度、濕度</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/pricing/">

    

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
    </style>

    
    <!-- Custom styles for this template -->
    <link href="pricing.css" rel="stylesheet">
    <script src="jquery.js"></script>
    <script>
        $(document).ready(function () {
             $('#tempauto').load("load/tempload.php");
             $('#btntemp').load("load/btntemp.php");
             $('#humauto').load("load/humload.php");
             $('#btnhum').load("load/btnhum.php");
             $('#sensauto').load("load/sensload.php");
             $('#btnsens').load("load/btnsens.php");
             $('#timeauto').load("load/timeload.php");
              setInterval(() => {
                 $('#tempauto').load("load/tempload.php");
                 $('#btntemp').load("load/btntemp.php");  
                 $('#humauto').load("load/humload.php");
                 $('#btnhum').load("load/btnhum.php");
                 $('#sensauto').load("load/sensload.php");
                 $('#btnsens').load("load/btnsens.php");
                 $('#timeauto').load("load/timeload.php");
            }, 10000);
        });
    </script>
  </head>
  <body>
    
<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <p class="h5 my-0 me-md-auto fw-normal">溫度濕度與空氣粉塵檢測</p>
  <nav class="my-2 my-md-0 me-md-3">
    <a class="p-2 text-dark" href="http://172.20.10.7/arduino2/bootstrap/dashboard/7day.php">最近7天</a>
    <a class="p-2 text-dark" href="http://172.20.10.7/arduino2/bootstrap/dashboard/record.php">搜尋日期</a>
    <a class="p-2 text-dark" href="#">關於</a>
  </nav>
  
  <a class="btn btn-outline-primary" href="#">GarZ</a>
  
</header>

<main class="container">
  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">PM2.5、溫度、濕度</h1>
    
    <p class="lead" id="timeauto">error</p>
  </div>

  <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
    <div class="col">
      <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 fw-normal">溫度</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title"><div id="tempauto">error</div></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>使用DHT11</li>
          <li>溫度測試</li>
          <li>請將機器放置在通風處</li>
        </ul>
        <button type="button" class="w-100 btn btn-lg btn-primary" id="btntemp">
          loading...
        </button>
      </div>
    </div>
    </div>
    <div class="col">
      <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 fw-normal">濕度</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title"><div id="humauto">error</div><small class="text-muted"></small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>使用DHT11</li>
          <li>濕氣測試</li>
          <li>請將機器放置在通風處</li>
        </ul>
        <button type="button" class="w-100 btn btn-lg btn-primary" id="btnhum">
          loading...
        </button>
      </div>
    </div>
    </div>
    <div class="col">
      <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 fw-normal">PM2.5</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title"><div id="sensauto">error</div> <small class="text-muted"></small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>使用SHARP GP2Y1014AU0F</li>
          <li>空氣品質偵測</li>
          <li>請將機器放置在通風處</li>
        </ul>
        <button type="button" class="w-100 btn btn-lg btn-primary" id="btnsens">
        loading...
        </button>
      </div>
    </div>
    </div>
  </div>
</main>
<script></script>
</body>
</html>
