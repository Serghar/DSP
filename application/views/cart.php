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
	<title>MICROPRISM - Your Cart</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
	<script>
	$(document).ready(function(){
		//AJAX for cart quantity
		/*$(document).on("submit", "#qty", function(){
			$.post(
				$(this).attr("action"),
				$(this).serialize(),
				function(output) {
					console.log(output);
				}
				);
			return false;
		});*/
	});
	</script>
	<style type="text/css">
		.linkButton { 
		     background: none;
		     border: none;
		     color: #337AB7;
		     text-decoration: none;
		     cursor: pointer;
		     text-decoration-color: #337AB7;
		}
		.linkButton:hover {
			outline:0;
			color: #23527C;
			text-decoration: underline;

		}
	</style>

</head>
<body>
	<div class="row" style='background-color: #E4F1FE; padding-bottom: 600px'>
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
								<td style="width: 300px">
									<form id="qty" action="/products/update_qty" method="post">
										<input type="hidden" name="product_id" value="<?=$product['id']?>">
										<input type="number" name="quantity" min="1" value=<?=$product['quantity']?> style="width:100px; text-align: right;">
										<button class="linkButton">update</button>| 
										<a href="/products/remove/<?=$product['id']?>">remove</a>
									</form>
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