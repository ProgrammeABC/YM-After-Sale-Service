<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>手机售后服务</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!-- <style>
		body {
			display: flex;
			flex-direction: column;
			min-height: 100vh;
		}
		main {
			flex-grow: 1;
			padding-top: 70px;
			padding-bottom: 30px;
		}
		.navbar-brand img {
			height: 50px;
			margin-right: 10px;
		}
		.footer {
			background-color: #f5f5f5;
			padding: 25px 0;
			margin-top: auto;
		}
		.body-container{
			padding-top:200px;
		}
	</style> -->
</head>
<body>
<?php include("static/part/nav.htm");?>

	<div class="container body-container">
		<h1 class="text-center mb-5">欢迎使用YUMI手机售后服务管理系统</h1>
		<div class="row justify-content-center">
			<div class="col-md-6">
				<a href="/asorder/warranty.php" class="btn btn-primary btn-lg btn-block mb-4">保修查询服务</a>
				<a href="/asorder/login.php" class="btn btn-primary btn-lg btn-block mb-4">自助售后单查询服务</a>
				<a href="/asorder/create.php" class="btn btn-primary btn-lg btn-block mb-4">自助申请售后单服务</a>
			</div>
		</div>
	</div>

	<?php include("static/part/foot.htm");?>
	<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js"></script>
	<!-- 引入jQuery等必要的前端资源 -->
	<script src="/static/jquery-3.6.4.js"></script>
	<script src="/static/bootstrap530a1/js/bootstrap.min.js"></script>
	<link href="/static/bootstrap530a1/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>
