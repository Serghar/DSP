<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> Purchasing </title> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

	<style type="text/css">
		#container{
			margin: 10px;
		}
	</style>
	<script>
		$(document).ready(function(){
			$(document).on("change", "#shiptobilling-checkbox", function() {
				if($(this).is(":checked")){
					$("[id^='billing_']").each(function(){
						data=$(this).attr("id")
						tmpID = data.split('billing_');
						$(this).val($("#shipping_"+tmpID[1]).val());
					})
				}else{
					$("[id^='billing_']").each(function(){
						$(this).val("")
					})
				}
			});

		});
	</script>

</head>
<body>
<div id = "container">

	<form action = "users/purchase_process" method = "post">
		<h2> Your information </h2>
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
			<input type = "text" id = "shipping_first_name_field" name = "shipping_first_name">
		</p>
		<p>
			Last Name:
			<input type = "text" id = "shipping_last_name_field" name = "shipping_last_name">
		</p>
		<p>
			Address:
			<input type = "text" id = "shipping_address_field" name = "shipping_address">
		</p>
		<p>
			Address 2:
			<input type = "text" id = "shipping_address_2_field" name = "shipping_address_2">
		</p>
		<p>
			City:
			<input type = "text" id = "shipping_city_field" name = "shipping_city">
		</p>
		<p>
			State:
			<input type = "text" id = "shipping_state_field" name = "shipping_state">
		</p>
		<p>
			Zipcode:
			<input type = "text" id = "shipping_zipcode_field" name = "shipping_zipcode">
		</p>

		<h1> Billing Information </h1>
		<!-- MAKE THIS WORK EVENTUALLY -->
		<p>
			<input id = "shiptobilling-checkbox" type = "checkbox" name = "same_info">
			Same as Shipping
		</p>
		<p>
			First Name:
			<input type = "text" id = "billing_first_name_field" name = "billing_first_name">
		</p>
		<p>
			Last Name:
			<input type = "text" id = "billing_last_name_field" name = "billing_last_name">
		</p>
		<p>
			Address:
			<input type = "text" id = "billing_address_field" name = "billing_address">
		</p>
		<p>
			Address 2:
			<input type = "text" id = "billing_address_2_field" name = "billing_address_2">
		</p>
		<p>
			City:
			<input type = "text" id = "billing_city_field" name = "billing_city">
		</p>
		<p>
			State:
			<input type = "text" id = "billing_state_field" name = "billing_state">
		</p>
		<p>
			Zipcode:
			<input type = "text" id = "billing_zipcode_field" name = "billing_zipcode">
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