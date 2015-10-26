<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Login Page </title>
</head>
<body>
	<h1> Login </h1>

	<form action = "/users/index" method = "post">
		<p> Email:
			<input type = "text" name = "email">
		</p>
		<p>
			Password:
			<input type = "password" name = "password">
		</p>
		<input type = "submit" value = "Login">
	</form>
	<p> </p>
	<a href="/"> Dont have an account? Fill info on payment page! </a>
</body>
</html>