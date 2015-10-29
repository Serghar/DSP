<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Admin Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous"> 
</head>	
<body>
	<?php if($this->session->flashdata('login_errors'))
	{
		echo $this->session->flashdata('login_errors');
	} ?>
<div id='container' style='text-align: center'><br><br>
	<div class='col-md-8' style='font-size: 16px'><strong>Welcome || Please log in</strong></div><br>
	<form class='col-md-8' action='/admins/login' method='post'>
		<input type='text' name='email'><br>
		<input type='password' name='password'><br><br>
		<input type='submit' value='Login'>
	</form>

</body>
</html>