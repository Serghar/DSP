<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Admin Login</title>

</head>	
<body>
	<?php if($this->session->flashdata('login_errors'))
	{
		echo $this->session->flashdata('login_errors');
	} ?>
	<form action='/admins/login' method='post'>
		<input type='text' name='email'>
		<input type='password' name='password'>
		<input type='submit' value='Login'>
	</form>

</body>
</html>