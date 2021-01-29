<?php require_once '../../../require.php';?>
<?php if($row_rs['t_temp']>30)
            echo '開冷氣 小心中暑';
            else if($row_rs['t_temp']>25)
            echo '開窗戶及電扇';
            else if($row_rs['t_temp']>20)
            echo '良好';
            else if($row_rs['t_temp']>16)
            echo '注意保暖';
            else if($row_rs['t_temp']>0)
            echo '打開暖氣';
          ?>