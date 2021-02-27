<?php require_once '../../../require.php';?>
<?php $hum =  $row_rs['t_humidity'] ;

    if($hum>60)
      {echo '請打開除濕機';}
    else if($hum<=60 && $hmm>40)
      {echo '良好';}
    else if($hum<=40 && $hum>30)
      {echo '請注意保濕!';} 
    else if($hum<=30 && $hum>0)
      {echo '請開啟加濕器!';} 
    else{
    echo '良好';
    };
          ?>