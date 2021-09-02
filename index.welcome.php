<!DOCTYPE html>
<html>
<head>
	<title>Automated Patent Record Managemant System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<div class="background"></div>
		<div class="link">
			<h1>Welcome to APRMS..</h1>
			<button id="log-btn">Login</button>
		</div>
		<div class="login-form" id="log-form">
			<div class="form-container">
				<small>Login to access the dashboard.</small>
				<form method="post">
					<input type="text" name="username" placeholder="username"><br>
					<input type="password" name="password" placeholder="password"><br>
					<input type="submit" value="Login">
					<input type="button" value="Cancel" id="cancel-btn">
				</form>
			</div>
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<script src="js/event.js"></script>
</body>
</html>