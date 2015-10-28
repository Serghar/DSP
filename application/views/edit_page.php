<?php if(!$this->session->userdata('admin'))
	{
		redirect('/');
	}
	$current_ids = array();  ?>

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
            $("button.category").on("click", function() {
            	/*need to make it when a category button is clicked it is
            	either added to categories for the item or removed

            	also need to make adding of new categories actually ajax
            	so it stays on this page and doesnt load the add page

            	this will also require making a partial for getting the
            	category button sections most likely*/
               });
        });
    </script>

</head>	
<body>

<h2>Edit Product -ID- <?= $product['id'] ?> </h2>
<form action='/products/update' method='post'>
	<p>Name: <input type='text' name='name' value='<?= $product['name']?>'></p>
	<p>Description:</p>
	<textarea name='description'><?= $product['description']?></textarea>
	<p>Price: <input type='text' name='price' value='<?=$product['price']?>'></p>
</form>
<p>Current Product Categories:</p>
<div>
	<?php foreach($product_categories as $category)
	{
		array_push($current_ids, $category['category_id']);?>
		<button class="current-category" cat_id="<?=$category['category_id']?>"><?=$category['category_name']?></button>
	<?php } ?>
</div>
<h4>Select a category to add:</h4>
<div>
	<?php foreach($all_categories as $category)
	{ 
		if(!(in_array($category['id'], $current_ids)))
		{ ?>
			<button class="category" cat_id="<?=$category['id']?>"><?=$category['name']?></button>
		<?php }
	} ?>
</div>

<form action="/products/new_category" method="post">
	<input type="text" name="category" placeholder="New category..">
	<input type='submit' value='Add Category'></p>
</form>


</body>
</html>