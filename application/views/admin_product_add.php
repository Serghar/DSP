<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create a new product</title>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script>
        $(document).ready(function(){
        	//load the avaliable categories
        	$.get("products/get_categories", function(res) {
            	build_cats(res);
        	}, 'json');

        	var cats = {};
            $(document).on("click", "button.category", function() {
            	var id = $(this).attr("cat_id");
            	var name = $(this).html();
            	cats[id] = name;
            	//build html str
            	var html_str = "";
            	for(key in cats)
            	{
            		html_str += "<li>";
            		html_str += "<button type='button' class='remove' cat_id='" + key + "'>";
	            	html_str += cats[key];
	            	html_str += "<input type='hidden' name='categories[]'";
	            	html_str += "value='" + key + "'>";
	            	html_str += "</button>";
	            	html_str += "</li>";
            	}
            	$("#current-cats").html(html_str);
            });
           
           	$(document).on('click', 'button.remove', function() {
           		var id = $(this).attr("cat_id");
           		delete cats[id];
           		//build html str
            	var html_str = "";
           		for(key in cats)
            	{
            		html_str += "<li>";
            		html_str += "<button type='button' class='remove' cat_id='" + key + "'>";
	            	html_str += cats[key];
	            	html_str += "<input type='hidden' name='categories[]'";
	            	html_str += "value='" + key + "'>";
	            	html_str += "</button>";
	            	html_str += "</li>";
            	}
            	$("#current-cats").html(html_str);
        	});

        	$(document).on("submit", "#new-category", function(){
    			$.post(
    				$(this).attr("action"),
    				$(this).serialize(),
    				function(output, testStatus) {
    					build_cats(output);
    				}, "json"
    				);
    			return false;
    		});

    		function build_cats(categories)
    		{
    			var html_str = "";
    			for(idx in categories)
    			{
    				html_str += "<button class='category'";
    				html_str += "cat_id='" + categories[idx].id + "'>";
    				html_str += categories[idx].name;
    				html_str += "</button>";
    			}
    			$("#categories").html(html_str);
    		};

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
	<div id="categories">
	</div>
	
	<form id="new-category" action="/products/new_category" method="post">
		<input type="text" name="category" placeholder="New category..">
		<input type='submit' value='Add Category'></p>
	</form>
	
	<input type='submit' value='Add Product' form="product-info">
</body>
</html>