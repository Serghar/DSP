<?php
//This page displays all the information for a product
/*var_dump($product_info);*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$product_info['name']?></title>
</head>
<body>
	<a href="/">Go back</a>
	<h1>Product Name: <?=$product_info['name']?></h1>
    <p>Description: <?=$product_info['description']?></p>
    <p>Price: $<?=$product_info['price']?></p>
    <form action="/products/cart/<?=$product_info['id']?>" method='post'>
    <p>Quantity: <input type="number" name="quantity"></p>
    <input type="submit" value="Add to cart">
</body>
</html>