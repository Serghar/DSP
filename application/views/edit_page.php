<?php if(!$this->session->userdata('admin'))
	{
		redirect('/');
	}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Edit Product Page</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

	<!-- JQuery Library -->
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
        	var url = document.URL;
	        var id = url.substring(url.length - 2, url.length);
        	update_cats();

        	$(document).on('click', 'button.category', function() {
        		var cat_id = $(this).attr("cat_id");
        		$.post(
    				"/products/add_category",
    				{ category_id: cat_id, product_id: id },
    				function() {
    					update_cats();
    				}
				);
        	});

        	$(document).on('click', 'button.current-category', function() {
        		var cat_id = $(this).attr("cat_id");
        		$.post(
    				"/products/remove_category",
    				{ category_id: cat_id, product_id: id },
    				function() {
    					update_cats();
    				}
				);
        	});

        	$(document).on("submit", "#new-category", function(){
    			$.post(
    				$(this).attr("action"),
    				$(this).serialize(),
    				function() {
    					update_cats();
    				}, "json"
    			);
    			return false;
    		});


        	function update_cats()
        	{
        		var current_ids = new Array();
        		//load the product's current categories
	            $.get("/products/product_categories_json/" + id, function(res) {
	            	var html_str = "";
	    			for(idx in res)
	    			{
	    				current_ids.push(res[idx].category_id);
	    				html_str += "<button class='current-category'";
	    				html_str += "cat_id='" + res[idx].category_id + "'>";
	    				html_str += res[idx].category_name;
	    				html_str += "</button>";
	    			}
	    			$("#categories").html(html_str);
	    			all_cats();
	            }, 'json');

	            //all this does is slows down the process so it can accurately create the current_ids array
	            function all_cats()
	            {
	            	//load the avaliable categories
		            $.get("/products/categories_json", function(res) {
		                var html_str = "";
		    			for(idx in res)
		    			{
		    				if($.inArray(res[idx].id, current_ids) == -1)
		    				{
		    					html_str += "<button class='category'";
			    				html_str += "cat_id='" + res[idx].id + "'>";
			    				html_str += res[idx].name;
			    				html_str += "</button>";
			    			}
			    			$("#new-categories").html(html_str);
		    			}
		            }, 'json');
	            } 
        	}
        });
    </script>

</head>	
<body>
	<h2>Edit Product -ID- <?= $product['id'] ?> </h2>
	<form action='/products/update' method='post'>
		<input type="hidden" name="id" value="<?=$product['id']?>">
		<p>Name: <input type='text' name='name' value='<?= $product['name']?>'></p>
		<p>Description:</p>
		<textarea name='description'><?= $product['description']?></textarea>
		<p>Price: <input type='text' name='price' value='<?=$product['price']?>'></p>
		<input type="submit" value="update">
	</form>
	<p>Current Product Categories:</p>
	<div id="categories">
	</div>
	<h4>Select a category to add:</h4>
	<div id="new-categories">
	</div>

	<form id="new-category" action="/products/new_category" method="post">
		<input type="text" name="category" placeholder="New category..">
		<input type='submit' value='Add Category'></p>
	</form>
</body>
</html>