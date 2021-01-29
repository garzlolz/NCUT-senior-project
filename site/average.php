<?php require_once '../require.php'?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>數據</title>
	<!-- Chart.js v2.4.0 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
</head>
<body>
    <a href="current.php"><img src="https://cdn.onlinewebfonts.com/svg/img_106257.png" width="15px"></a>
	<canvas id="example" width="400" height="200"></canvas>
	<script>
		var ctx = document.getElementById( "example" ),
		example = new Chart(ctx, {
				// 參數設定[註1]
				type: "bar", // 圖表類型
				data: {
					// 資料設定[註2]
					labels: [ "溫度", "濕度", "空氣品質" ], // 標題
					datasets: [{
						// 資料參數設定[註3]
						label: ["平均值"], // 標籤
						data: [ <?php echo $row_rs['t_temp']; ?>, <?php echo $row_rs['t_humidity']; ?>, <?php echo $row_rs['t_sensor']; ?> ], // 資料
						backgroundColor: [ // 背景色
						"#FF0000",
						"#00FF00",
						"#0000FF",
						],
						borderWidth: 1 // 外框寬度
					}]
				}
			});
	</script>
</body>
</html>
