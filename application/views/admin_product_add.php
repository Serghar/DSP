<?php
var_dump($categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create a new product</title>
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
	<?php
	if($this->session->flashdata('add_errors'))
	{
		echo $this->session->flashdata('add_errors');
	}
	?>
	<form id="product-info" action='/products/create' method='post'>
    	<p>Name: <input type='text' name='name'></p>
    	<textarea name='description' placeholder='Enter a description...'></textarea>
    	<p>Price: <input type='text' name='price'></p>
		<p>Current Product Categories:</p>
		<ul id="current-cats">
		</ul>
		</form>
	<h4>Select a category to add:</h4>
	<div>
		<?php foreach($categories as $category)
		{ ?>
			<button class="category" cat_id="<?=$category['id']?>"><?=$category['name']?></button>
		<?php } ?>
	</div>
	
	<form action="/products/new_category" method="post">
		<input type="text" name="category" placeholder="New category..">
		<input type='submit' value='Add Category'></p>
	</form>
	
	<input type='submit' value='Add Product' form="product-info">
</body>
</html>