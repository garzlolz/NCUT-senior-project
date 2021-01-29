<?php require_once '../../../require.php';?>
<?php if($row_rs['t_humidity']>60)
            echo '開啟除濕機';
            else if($row_rs['t_humidity']=45)
            echo '完美';
            else if($row_rs['t_humidity']>40)
            echo '良好';
            else if($row_rs['t_humidity']>30)
            echo '請注意保濕';
            else if($row_rs['t_humidity']>0)
            echo '請打開加濕器!';
          ?>