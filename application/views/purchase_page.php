<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> Purchasing </title> 
</head>
<body>


<h1> Payment Page </h1>
<form action = "users/purchase_process" method = "post">
	<h1> Your Information </h1>
	<p>
		Email
		<input type = "text" name = "email">
	</p>
	<p>
		Password
		<input type = "password" name = "password"
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

</body>
</html>