<?php if(!$this->session->userdata('admin'))
	{
		redirect('/');
	} ?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title></title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script type='text/javascript'>
            // $(document).ready(function() {
                // $('form').submit(function() {
                    // $.get("/admins/searches", function(output)
                    // {
                        // console.log(output);
                        // $('body').html(output);
                    // });
                    // return false;
                // });
            // })
            </script>

</head>	
<body>
    <div id='header'>
        <h2>Dashboard</h2>
        <a href='/admins/orders'>Orders</a>
        <a href='/admins/products'>Products</a>
        <a href='/admins/logoff'>Log Off</a>
    </div>
    
    <form action='/admins/searches' method='post'>
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
                 <?php if(isset($results))
                 { ?> 
<!--                 <thead> 
                    <th>Picture</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Inventory Count</th>
                    <th>Quantity sold</th>
                    <th>Action</th>
                </thead> -->

                 <?php
                    foreach ($results as $result)
                    {
                        echo "<tr><td>{$result['id']}</td><td>{$result['id']}</td><td>{$result['name']}</td><td>{$result['name']}</td><td>{$result['name']}</td><td><a href='/admins/edit_product/{$result['id']}'>edit</a> <a href='/admins/delete_prod/{$result['id']}'>delete</a></td></tr>";
                    }

                } 

                 foreach ($products as $product) {
                    echo "<tr><td>" . $product['name'] . "</td>";
                    echo "<td>" . $product['id'] . "</td>";
                    echo "<td>" . $product['name'] . "</td>";
                    echo "<td>" . $product['name'] . "</td>";
                    echo "<td>" . $product['name'] . "</td>";
                    echo "<td><a href='/admins/edit_product/{$product["id"]}'>edit</a> <a href='/admins/delete_prod/{$product["id"]}'>delete</a></td></tr>";
                    } ?>
        </tbody>
    </table>
</body>
</html>
