<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Water Consumption in CPSU Main Campus!</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style type="text/css">
body {
	background: #fff
}

#form {
	width: 300px;
	margin: 0 auto;
	border: 10px solid rgba(0, 0, 0, 0);
	border-radius: 50px;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
	margin-top: 5%;
	text-align: center; /* Added to center align the form content */
}

#form input[type="submit"] {
	margin-top: 20px; /* Added to add some spacing */
}
</style>
</head>

<body>
<div id="form">
	<img src="img\logo.webp" height="90" width="100">
	<h1>Water Consumption in CPSU Main Campus!</h1>
	<form method="post" action="process.php" class="form-horizontal">
		<div class="form-group">
			<label class="control-label col-sm-8">User Name:</label>
			<div class="col-sm-12">
				<input type="text" name="username" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-8">Password:</label>
			<div class="col-sm-12">
				<input type="password" name="password" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-8">
				<input type="submit" value="Login" name="ok" class="btn btn-primary">
			</div>
		</div>
	</form>
	<?php
		if (isset($_GET['err']) && $_GET['err'] == '1') {
			echo "<script>alert('Invalid Username or Password')</script>";
		}
	?>
</div>
</body>
</html>
