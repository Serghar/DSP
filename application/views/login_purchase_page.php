<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Success Page </title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"> </script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

	<style type="text/css">
		#contianer{
			margin: 15px;
		}
	</style>
</head>
<body>
	<div id = "container">
	
		<h3> <a href="/users/logout"> Logout </a> </h3>

		<h2> Thank You for Shopping Again With Us <?= $login_user['first_name'] ?> </h2>
		
		<table>
			<thead>
				<th> Item </th>
				<th> Price </th>
				<th> Quantity </th>
				<th> Total </th>
			</thead>
			<? //foreach($all_products as $product) { ?>
				<tr>
					<td> GUCCI BELLTTT </td>
					<td> $19.99 </td>
					<td> 1 <a href="______"> Update </a> <a href="______"> Delete </a>  </td>
					<td> $ 19.99 </td>
				</tr>
		</table>

		<form action = "user/testing" method = "post">
			<h2> Shipping Information </h2>
			<p>
				First Name: <?=$login_user['first_name']?>
			</p>
			<p>
				Last Name: <?=$login_user['last_name']?>
			</p>
			<p>
				Address: <?=$login_user['s_street']?>
			</p>
			<p>
				Address 2: <?=$login_user['s_address_2'] ?>
			</p>
			<p>
				City: <?=$login_user['s_city'] ?>
			</p>
			<p>
				State: <?=$login_user['s_state'] ?>
			</p>
			<p>
				Zipcode: <?=$login_user['s_zipcode'] ?>
			</p>

			<h2> Billing Information </h2>
			<p>
				First Name: <?=$login_user['first_name']?>
			</p>
			<p>
				Last Name: <?=$login_user['last_name']?>
			</p>
			<p>
				Address: <?=$login_user['b_street']?>
			</p>
			<p>
				Address 2: <?=$login_user['b_address_2'] ?>
			</p>
			<p>
				City: <?=$login_user['b_city'] ?>
			</p>
			<p>
				State: <?=$login_user['b_state'] ?>
			</p>
			<p>
				Zipcode: <?=$login_user['b_zipcode'] ?>
			</p>
			<p>
				Card #: <?=$login_user['card_number'] ?>
			</p>
			<p>
				Security Code: <?=$login_user['security_code'] ?>
			</p>
			<p>
				Expiration: <?=$login_user['expiration_date'] ?>
			</p>
			<input type = "submit" value = "Pay">
			<break>
		</form>

		
		<form action = "_______" method = "post">
			<button> Update Profile </button>
		</form>
	</div>
</body>
</html>