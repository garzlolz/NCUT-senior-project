<?php require '../Connections/garzconn.php'?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>testjq</title>
    <script src="jquery.js"></script>
    <script>
       $(document).ready(function () {
            $('#autorefresh').load("load.php");
            setInterval(() => {
                $('#autorefresh').load("load.php");
            }, 3000);
        });
    </script>
</head>
<body>
    <div id="autorefresh"></div>
</body>
</html>