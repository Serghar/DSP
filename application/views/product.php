<?php
//get cart size
$cartSize = count($this->session->userdata('cart'));
//This page displays all the information for a product
/*var_dump($product_info);*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$product_info['name']?></title>
	<link rel="stylesheet" type="text/css" href="assets/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
    <div class='container-fluid' style='background-color: #E4F1FE'>
    	<div class='row'>
			<a class='col-md-1' href="/">Go back</a>
		</div>
		<div class='row'>
			<h1 class='col-md-3 pull-left'><?=$product_info['name']?></h1><br>
			<img class='col-md-6 col-md-offset-1' src='/assets/photo_<?= $product_info['id']?>.jpg' height=400 width=400>
			<p class='col-md-6 col-md-offset-4'><?=$product_info['description']?></p>
    		<p class='col-md-6 col-md-offset-4'>Price: $<?=$product_info['price']?></p>
    		<form class='col-md-6 col-md-offset-4' action="/products/add_cart/<?=$product_info['id']?>" method='post'>
    			<p>Quantity: 
    			<input type="number" name="quantity">
    			<input type="submit" value="Add to cart"></p>
			</form>
		</div>
	</div>
</body>
</html>