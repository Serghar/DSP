<?php 
//get cart size
$cartSize = count($this->session->userdata('cart'));
//variable to see if the cart has items in it
(empty($products) ? $has_items = false : $has_items = true);

//create order total here
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Cart</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
</head>
<body>
	<div class="row">
  		<div class="col-md-8 col-md-offset-2">
			<h1>Current Cart</h1>
			<?php if ($has_items)
			{ ?>
				<table class="table table-hover table-bordered">
					<thead>
						<th>Item</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
					</thead>
					<tbody>
						<?php foreach($products as $product)
						{
							//set the individual product total cost
							$product_total = $product['price'] * $product['quantity'];
							//increment order total by this amount
							$total += $product_total; ?>
							
							<tr>
								<td><?=$product['name']?></td>
								<td>$<?=$product['price']?></td>
								<td>
									<?=$product['quantity']?> 
									<a href="/products/remove/<?=$product['id']?>">remove</a>
								</td>
								<td>$<?=$product_total?></td>
							</tr>	
						<?php } ?>
					</tbody>
				</table>
				<div class="pull-right">
					<h3>Total: $<?=$total?></h3>
					<a href="/"><button type="button" class="btn btn-info">Continue Shopping</button></a>
				</div>
			</div>
		</div>
	<?php }
	else{ ?>
		<h2>Your cart is currently empty!</h2>
		<a href="/"><button type="button" class="btn btn-warning">Go Back</button></a>
	<?php } ?>
</body>
</html>