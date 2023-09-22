<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>设备保固查询</title>
    <style type="text/css">
        body {
            font-family: "San Francisco", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .body-container {
            
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            padding-top:60px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }

        form input[type="text"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-weight: 400;
            line-height: 1.5;
            color: #333;
            background-color: #f5f5f5;
            border: none;
            border-radius: 4px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        button[type="submit"] {
            display: block;
            margin-top: 20px;
            padding: 10px;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.5;
            color: #fff;
            background-color: #007aff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button[type="submit"]:hover {
            background-color: #0062cc;
        }

        #result {
            margin-top: 20px;
            font-size: 16px;
            font-weight: 400;
            color: #333;
        }
        .page-title{
            text-align: center;
            padding-bottom: 50px;
        }

    </style>


</head>
<body>
<?php include("../static/part/nav.htm");?>
	<div class="container body-container">
        <h2 class="page-title">查看您的YUMI Phone的保障状态</h2>
		<form id="warranty-form">
			<label for="imei">IMEI:</label>
			<input type="text" id="imei" name="imei">
			<!-- <label for="activeTime">Active Time:</label>
			<input type="text" id="activeTime" name="activeTime"> -->
			<span class="picker-icon"></span>
			<button type="submit">查询保修</button>
		</form>
		<div id="result"></div>
        <h2 class="page-title"><img src="/static/img/yumi.png" height="50px"></h2>
	</div>
    <?php include("../static/part/foot.htm");?>
<!-- 引入jQuery等必要的前端资源 -->
<script src="/static/jquery-3.6.4.js"></script>
<script src="/static/bootstrap530a1/js/bootstrap.min.js"></script>
<link href="/static/bootstrap530a1/css/bootstrap.min.css" rel="stylesheet">
	<script>
		$(document).ready(function() {
			$("#warranty-form").submit(function(event) {
				event.preventDefault();
				var imei = $("#imei").val();

				$.get("/server/warranty.php", {imei: imei}, function(data) {
					if (data != "No matching record found.") {
						// 显示结果
						$("#result").html(data);
					} else {
						// 显示错误信息
						$("#result").html("<p class='error'>此IMEI不存在！</p>");
					}
				});
			});
		});
	</script>
</body>
</html>
