<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> Purchasing </title> 
</head>
<body>

<?php //var_dump($login_info); ?>
<div id = "container">

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

	<form action = "users/purchase_process" method = "post">
		<h2> Create a New User </h2>
			<p> Email: 
				<input type = "email" name = "email">
			</p>
			<p>
				Password:
				<input type = "password" name = "password">
			</p>

		<h1> Shipping Information </h1>
		<p>
			First Name:
			<input type = "text" name = "shipping_first_name">
		</p>
		<p>
			Last Name:
			<input type = "text" name = "shipping_last_name">
		</p>
		<p>
			Address:
			<input type = "text" name = "shipping_address">
		</p>
		<p>
			Address 2:
			<input type = "text" name = "shipping_address_2">
		</p>
		<p>
			City:
			<input type = "text" name = "shipping_city">
		</p>
		<p>
			State:
			<input type = "text" name = "shipping_state">
		</p>
		<p>
			Zipcode:
			<input type = "text" name = "shipping_zipcode">
		</p>



		<h1> Billing Information </h1>
		<p>
			<input type = "checkbox" name = "same_info">
			Same as Shipping
		</p>
		<p>
			First Name:
			<input type = "text" name = "billing_first_name">
		</p>
		<p>
			Last Name:
			<input type = "text" name = "billing_last_name">
		</p>
		<p>
			Address:
			<input type = "text" name = "billing_address">
		</p>
		<p>
			Address 2:
			<input type = "text" name = "billing_address_2">
		</p>
		<p>
			City:
			<input type = "text" name = "billing_city">
		</p>
		<p>
			State:
			<input type = "text" name = "billing_state">
		</p>
		<p>
			Zipcode:
			<input type = "text" name = "billing_zipcode">
		</p>
		<p>
			Card #:
			<input type = "text" name = "card_number">
		</p>
		<p>
			Security Code:
			<input type = "text" name = "security_code">
		</p>
		<p>
			Expiration:
			<input type = "date" name = "expiration_date">
		</p>
		<input type = "submit" value = "Pay">
	</form>
</div>

</body>
</html>