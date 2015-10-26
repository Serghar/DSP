<?php if(!$this->session->userdata('admin'))
	{
		redirect('/');
	} ?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title></title>

</head>	
<body>
    <ul>
    <?php var_dump($this->session->userdata);

    foreach($products as $product)
    { ?>
        <li>
            <p>Name: <?=$product['name']?></p>
            <p>Description: <?=$product['description']?></p>
            <p>Price: $<?=$product['price']?></p>
        </li>
    <?php } ?>
    </ul>

    <form action='/products/add' method='post'>
    	Name: <input type='text' name='name'>
    	Description: <textarea name='description'></textarea>
    	Price: <input type='text' name='price'>
    	<input type='submit' value='Add Product'>
    </form>

</body>
</html>
