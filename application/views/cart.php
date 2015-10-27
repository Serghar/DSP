<?php 

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
</head>
<body>
	<h1>Current Cart</h1>
	<?php if ($has_items)
	{ ?>
		<table border="1">
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
		<p>Total: $<?=$total?></p>
		<a href="/"><button>Continue Shopping</button></a>
		<a href="/checkout"><button>Checkout</button></a>
	<?php }
	else
	{ ?>
		<h2>Your cart is currently empty!</h2>
		<a href="/"><button>Go back</button></a>
	<?php } ?>
</body>
</html>