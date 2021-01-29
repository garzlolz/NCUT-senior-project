<!--______________________________________________________________________________________________________
  |______________________________________MYSQL CONNECT____________________________________________________|-->
  <?php include('Connections/garzconn.php');?>
<?php
  $currentPage = $_SERVER["PHP_SELF"];
  $maxRows_rs = 10;
  $pageNum_rs = 0;
  
  if (isset($_GET['pageNum_rs'])) {
     $pageNum_rs = $_GET['pageNum_rs'];
  }

  $startRow_rs = $pageNum_rs * $maxRows_rs;

//SELECT DB

  mysql_select_db($database_garz, $garz);
  if($_GET['so']==""){
  $query_rs = "SELECT * FROM temperature ORDER BY t_id DESC";
  }else{
  $query_rs = "SELECT * FROM temperature where t_time like '%".$_GET['so']."%' ORDER BY t_id DESC";
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
