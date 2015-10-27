<?php if(!$this->session->userdata('admin'))
	{
		redirect('/');
	} ?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title></title>

</head>	
<body>
    <div id='header'>
        <h2>Dashboard</h2>
        <a href='/admins/orders'>Orders</a>
        <a href='/admins/products'>Products</a>
        <a href='/admins/logoff'>Log Off</a>
    </div>
    <!-- <ul> -->
    <?php /* var_dump($this->session->userdata);

    foreach($products as $product)
    { ?>
        <li>
            <p>Name: <?=$product['name']?></p>
            <p>Description: <?=$product['description']?></p>
            <p>Price: $<?=$product['price']?></p>
            <a href="/products/delete/<?=$product['id']?>">DELETE</a>
        </li>
    <?php } */ ?>
    <!-- </ul> -->
    <table>
        <thead>
            <th>Order ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Billing Address</th>
            <th>Total</th>
            <th>Status</th>
        </thead>
        <tbody>
            <?php  foreach ($orders as $order) {
                echo "<tr><td>" . $order['orders_id'] . "</td>";
                echo "<td>" . $order['name'] . "</td>";
                echo "<td>" . $order['created_at'] . "</td>";
                echo "<td>" . $order['billing_id'] . "</td>";
                echo "<td>" . $order['total'] . "</td>";
                echo "<td><select><option value= {$order['status']}>{$order['status']}</option><option value='Order in process'>Order in Process</option><option value='Cancelled'>Cancelled</option><option value='Shipped'>Shipped</option> </select></td></tr>";
            } ?> 
        </tbody>
    </table>
    <a href="/products/add"><button>Add new Product</button></a>

</body>
</html>
