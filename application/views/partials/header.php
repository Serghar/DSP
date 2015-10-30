<?php
//get cart size
$cartSize = count($this->session->userdata('cart'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MICROPRISM</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"> </script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

</head>
<body>
	<div class="container-fluid">
        <div class='row' style='background-color: #89C4F4; border-bottom: 1px solid #BE90D4'><br>
            <div class='col-md-2' style='font-size: 18px; color: #EEEEEE'><a style='text-decoration: none; color: #EEEEEE' href='/products'>MICROPRISM</a></div>
            <div class='col-md-5' style='font-size: 18px; color: #EEEEEE'>Curating / Selling fine photography</div>
            <div class='col-md-3 col-md-offset-1'><a style='font-size: 18px; color: #FDE3A7' href="/cart"><i class="fa fa-shopping-cart"></i> Your Shopping Cart (<?=$cartSize?>)</a></div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login">Login</button><br><br>
        </div>

    </div>
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="accountlogin">
		  <div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="accountlogin">Login to your account</h4>
		      </div>
		      <form id ="user-login" action ="/users/login_process" method ="post">
		      	<div class="modal-body">
		          <div class="form-group">
		            <label for="email-field" class="control-label">Email:</label>
		            <input type="email" name="email" class="form-control" id="email-field" required>
		          </div>
		          <div class="form-group">
		            <label for="password-field" class="control-label">Password:</label>
		            <input type="password" name="password" class="form-control" id="password-field" required>
		          </div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<input type="submit" value="Login" class="btn btn-primary">
	        	</div>
		        </form>
		      </div>
		   </div>
		</div>
</body>
</html>