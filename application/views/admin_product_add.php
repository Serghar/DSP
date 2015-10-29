<?php
// var_dump($categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create a new product</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous"> 
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script>
        $(document).ready(function(){
        	var cats = {};
            $("button.category").on("click", function() {
            	var id = $(this).attr("cat_id");
            	var name = $(this).html();
            	cats[id] = name;
            	console.log(cats);
            	//build html str
            	var html_str = "";
            	for(key in cats)
            	{
            		html_str += "<li>";
	            	html_str += cats[key];
	            	html_str += "<input type='hidden' name='categories[]'";
	            	html_str += "value='" + key + "'>";
	            	html_str += "</li>";
            	}
            	$("#current-cats").html(html_str);
               });
        });
    </script>
</head>
<body>
	<div class='container'>
        <div class='row' style='background-color: #22A7F0; border-bottom: 2px solid #BDC3C7'><br>
            <div class='col-md-3 pull-left' style='color: #FDE3A7; font-size: 16px; front-weight: 300'>Dashboard</div>
            <a class='col-md-3 pull-right' href='/admins/orders' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Orders</a>
            <a class='col-md-3 pull-right' href='/admins/products' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Products</a>
            <a class='col-md-3 pull-right' href='/admins/logoff' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Log Off</a>
            <br><br>
        </div>
    </div>
	<?php
	if($this->session->flashdata('add_errors'))
	{
		echo $this->session->flashdata('add_errors');
	}
	?>
	<div class='container' style='background-color: #A2DED0'>
		<div class='row'><br>
			<div class='col-md-4' style='font-size: 16px'><strong>Add a Product</strong></div> <br>
		</div>
		<form id="product-info" action='/products/create' method='post'>
    		<p>Name: <input type='text' name='name'></p>
    		<p>Description: </p>
    		<textarea class='col-md-8' cols=21 rows=5 name='description' placeholder='Enter a description...'></textarea><br><br>
    		<p>Price: <input class='cold-md-4' style='width: 157px' type='text' name='price'></p>
			<p><strong>Current Product Categories:</strong></p><br>
			<ul id="current-cats">
			</ul>
		</form>
	<h4>Select a category to add:</h4><br>
	<div>
		<?php foreach($categories as $category)
		{ ?>
			<button class="category" cat_id="<?=$category['id']?>"><?=$category['name']?></button>
		<?php } ?>
	</div><br>
	
	<p><strong>Or add a new category:</strong></p>
	<form action="/products/new_category" method="post">
		<input type="text" name="category" placeholder="New category..">
		<input type='submit' value='Add Category'></p>
	</form>
	<br>
	<input class='cols-md-4' type='submit' value='Add Product' form="product-info"><br>
	<br>
</body>
</html>