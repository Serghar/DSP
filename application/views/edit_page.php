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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous"> 
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
	<div class='container' style='background-color: #22A7F0'>
		<div class='row' style='background-color: #22A7F0; border-bottom: 2px solid #BDC3C7'><br>
			<div class='col-md-3 pull-left' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Dashboard</div>
			<a class='col-md-3 pull-right' href='/admins/orders' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Orders</a>
	            <a class='col-md-3 pull-right' href='/admins/products' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Products</a>
	            <a class='col-md-3 pull-right' href='/admins/logoff' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Log Off</a>
	            <br><br>
	    </div>
	</div>
	<div class='container' style='background-color: #A2DED0'><br>
		<div class='row'>
			<div class='col-md-3 pull-left' style='color: black; font-size: 16px; font-weight: 300px'><strong>Edit Product - ID <?= $product['id'] ?> </strong></div>
		</div>
		<div class='row'>
			<div class='col-md-4'></div>
			<div class='col-md-4'><br>
			<form action='/products/update' method='post'>
		<p>Name: <input class='col-md-4' type='text' name='name' value='<?= $product['name']?>'></p>
		<p>Description:</p>
		<textarea class='col-md-8' cols=25 rows=5 name='description'><?= $product['description']?></textarea><br><br>
		<p>Price: <input class='col-md-4' style='width:182px'type='text' name='price' value='<?=$product['price']?>'></p>
	</form>
	<p>Current Product Categories:</p>
	<div id="categories">
	</div>
	<h4>Select a category to add:</h4>
	<div id="new-categories">
	</div>
	<br>
	<div class='row'>
		<div class='col-md-4'><strong>Or add a new category: </strong></div>
	</div>
	<br>
	<form id="new-category" action="/products/new_category" method="post">
			<input type="text" name="category" placeholder="New category..">
			<input type='submit' value='Add Category'></p>
	</form>
	</div>
</body>
</html>