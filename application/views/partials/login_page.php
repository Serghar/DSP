<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Login Page </title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"> </script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

	<style type="text/css">
		#container{
			margin: 10px;
		}
	</style>

</head>
<body>
	
	<div id = "container">
	<?= $this->session->flashdata('errors') ?>
	<?= $this->session->flashdata('success') ?>

	<form action = "/users/login_process" method = "post">
		<h1> Login </h1>
		<p>
			Email:
			<input type = "email" name ="email">
		</p>
		<p>
			Password:
			<input type = "password" name="password">
		</p>
		<input type = "submit" value = "Login">
	</form>
</div>
	
</body>
</html>