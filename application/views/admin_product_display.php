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
    <div id='header'>
        <h2>Dashboard</h2>
        <a href='/admins/orders'>Orders</a>
        <a href='/admins/products'>Products</a>
        <a href='/admins/logoff'>Log Off</a>
    </div>
    
    <form action='' method='post'>
        <input type='text' name='search'>
        <input type='submit' value='Search'>
    </form>
    <button name='Add'><a href='/admins/create'>Add new product</a></button>
    <table>
        <thead>
            <th>Picture</th>
            <th>ID</th>
            <th>Name</th>
            <th>Inventory Count</th>
            <th>Quantity sold</th>
            <th>Action</th>
        </thead>
        <tbody>
            <tr>
    <?php foreach ($products as $product) {
        echo "<td>" . $product[''];

    }

    ?>
            </tr>
        </tbody>
    </table>



</body>
</html>
