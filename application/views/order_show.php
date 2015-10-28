<?php echo "sup this will be the order page for order #{$id}" ?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Order View Page</title>
</head>
<body>
	<h2>Dashboard</h2>
	<a href='/admins/orders'>Orders</a>
	<a href='/admins/products'>Products</a>
	<a href='/admins/logoff'>Log Off</a>

	<div id='order_customer'>
		<p>Order ID: <?= $id ?></p>
		<p></p>
		<p><strong>Customer shipping info: </strong></p>
		<p>Name: </p>
		<p>Address: </p>
		<p>City: </p>
		<p>State: </p>
		<p>Zip: </p>
		<p></p>
		<p><strong>Customer billing info: </strong></p>
		<p>Name: </p>
		<p>Address: </p>
		<p>City: </p>
		<p>State: </p>
		<p>Zip: </p>
	</div>

	<table>
		<thead>
			<th>ID</th>
			<th>Item</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Total</th>
		</thead>
		<tbody>

		</tbody>
	</table>
	<div id='ord_status'>
		<p>Status: </p>
	</div>
	<div id='ord_costs'>
		<p>Sub total: </p>
		<p>Shipping: </p>
		<p>Total Price: </p>
	</div>

</body>