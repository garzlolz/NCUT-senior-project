<?php require '../Connections/garzconn.php'?>
<?php
    $sql = "SELECT * FROM `arduino_db`.`temperature`  WHERE `t_time` LIKE '%20:00:0%' ORDER BY t_id LIMIT 0 , 10";
    $result = mysql_query($sql) ;
    /*while($row = mysql_fetch_array($result)){//印出資料 echo $row['t_sensor']." "."<br>";}*/
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>折線圖</title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    </head>
    <body>
    <a href="current.php"><img src="https://cdn.onlinewebfonts.com/svg/img_106257.png" width="15px"></a>
    
        
        <canvas id="myChart"></canvas>

        <script>
            (function(){
                'use strict';
                //date("F j, Y g:i a", strtotime($row_rs["t_time"]))
                var tt=[<?php while($row = mysql_fetch_array($result)){ echo date("'".$row['t_time'].""."',");}?>];    
                <?php mysql_data_seek($result,0);?>  
                var type='line';
                var data = {
                    labels:tt,
                    
                    datasets:[
                        {
                            label:'PM2.5',
                            data:[<?php  while($row = mysql_fetch_array($result)){echo $row['t_sensor']." ".",";}?>],
                            borderColor:'red',
                            borderWidth:3,
                            fill:true,
                            backgroundColor:'rgba(128,0,0,0.5)',
                            lineTension:0,
                            pointStyle:'circle',
                            pointRadius: 8,
                            <?php mysql_data_seek($result,0);?>
                        },
                        {
                            label:'溫度',
                            data:[<?php  while($row = mysql_fetch_array($result)){echo $row['t_temp']." ".",";}?>],
                            borderColor:'green',
                            borderWidth:3,
                            fill:true,
                            backgroundColor:'rgba(0,128,0,0.5)',
                            lineTension:0,
                            pointStyle:'triangle',
                            pointRadius: 8,
                            <?php mysql_data_seek($result,0);?>
                        },
                        {
                            label:'濕度',
                            data:[<?php  while($row = mysql_fetch_array($result)){echo $row['t_humidity']." ".",";}?>],
                            borderColor:'blue',
                            borderWidth:3,
                            fill:true,
                            backgroundColor:'rgba(0,0,128,0.5)',
                            lineTension:0,
                            pointStyle:'crossRot',
                            pointRadius: 8,
                            <?php mysql_data_seek($result,0);?>
                        },
                            ]
                };
                var ctx= document.getElementById('myChart').getContext('2d');
                var chart = new Chart(ctx,{
                    type:type,
                    data:data,

                    options:{
                        title:{
                            display:true,
                            text:'近日晚間8點',
                            fontColor:'red',
                            fontSize:'24'
                        }
                    }
                })
            })();
        </script>
    </body>
</html>