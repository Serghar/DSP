<?php if(!$this->session->userdata('admin'))
	{
		redirect('/');
	} ?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Edit Product Page</title>
	<style>

	</style>

</head>	
<body>

<h2>Edit Product - ID <?= $product['id'] ?> </h2>
<form action='/products/update' method='post'>
	Name: <input type='text' name='name' placeholder='<?= $product['name']?>'><br>
	Description: <textarea name='description' placeholder='<?= $product['description']?>'></textarea><br>
	Categories: <select>
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