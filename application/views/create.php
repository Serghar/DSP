<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Add a New Product</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
</head>
<body>

<h2>Add a New Product</h2>
<form action='/products/add' method='post'>
	Name <input type='text' name='name'><br>
	Description <textarea name='description'></textarea><br>
	Categories: <select name = 'existing_category'>
					<option value='select'>Select</option>
					<?php foreach ($categories as $category)
					{ ?>
					<option value='<?= $category['id']?>'>
						<?php echo $category['name']; ?>
					</option>
					<?php } ?>
				</select><br> 
	or add new category: <input type='text' name='new_category'><br>			
	Images <button name='upload'>Upload</button><br>
	<button name='cancel'><a href='/admins/products'>Cancel</a></button>
	<button name='preview' value='preview'>Preview</button>
	<input type='submit' value='Update'>
</form>
</body>
</html>