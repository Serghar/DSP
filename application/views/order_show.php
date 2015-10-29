<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Order View Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous"> 
</head>
<body>
<div class='container' style='background-color: #22A7F0'>
	<div class='row' style='background-color: #22A7F0; border-bottom: 2px solid #BDC3C7'><br>
		<div class='col-md-3 pull-left' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Dashboard</div>
		<a class='col-md-3 pull-left' href='/admins/orders' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Orders</a>
            <a class='col-md-3 pull-left' href='/admins/products' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Products</a>
            <a class='col-md-3 pull-right' href='/admins/logoff' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Log Off</a>
            <br><br>
    </div>
</div>
<div class='container' style='background-color: #A2DED0'><br>
	<div class='row'>
		<div id='order_customer' style='padding: 5px; margin: 5px; height: 200; border: 1px solid black'>
			<p><strong>Order ID:</strong> <?= $id ?></p>
			<p></p>
			<p><strong>Customer shipping info: </strong></p>
			<p>Name: <?= $infos['first_name'] ?> Address: <?= $infos['street'] ?> City: <?= $infos['city'] ?> State: <?= $infos['state'] ?> Zip: <?= $infos['zipcode'] ?> </p>
			<p></p>
			<p><strong>Customer billing info: </strong></p>
			<p>Name: <?= $infos['billing_name'] ?> Address: <?= $infos['billing_street'] ?>City: <?= $infos['billing_city'] ?> State: <?= $infos['billing_state'] ?> Zip: <?= $infos['billing_zipcode'] ?> </p>
		</div>
	</div>
</div>
<div class='container' style='background-color: #A2DED0'><br>
	<div class='table'>
		<table class='table' style="background-color: #ECECEC; color: #6C7A89">
			<thead>
				<th>ID</th>
				<th>Item</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
			</thead>
			<tbody>
				<?php foreach ($orders as $order) { 
					echo "<tr><td>{$order['product_id']}</td><td>{$order['name']}</td><td>{$order['price']}</td><td>{$order['quantity']}</td><td>{$order['total']}</td></tr>";
			 } ?>
			</tbody>
		</table>
	</div>
</div>
<div class='container' style='background-color: #A2DED0'>
	<div class='div-inline' style='display: block'>
		<div id='ord_costs' style='background-color: #A2DED0; border: 1px solid black; width: 190px; padding: 5px; margin: 5px' class='pull-right'>
			<p>Total Price: $<?= $status['total'] ?></p>
		</div>
		<div id='ord_status' style='background-color: #A2DED0; border: 1px solid black; width: 190px; padding: 5px; margin: 5px' class='pull-right'>
			<p>Status: <?= $status['status']?></p>
		</div>
	</div>
</div>
</body>
</html>