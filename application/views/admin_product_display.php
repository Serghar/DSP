<?php if(!$this->session->userdata('admin'))
	{
		redirect('/');
	} ?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Admin Product Display</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous"> 
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script type='text/javascript'>
            $(document).ready(function() {
                // console.log('hey');
                $('form').submit(function() {
                    $.get('/admins/products_json', function(display)
                    {
                        var row = "<thead><th>Picture</th><th>ID</th><th>Name</th><th>Inventory Count</th><th>Quantity sold</th><th>Action</th></thead>";
                        var search_term = $('input[name="search"]').val();
                        for (var i = 0; i < display.length; i++)
                        {
                            if(search_term == display[i].name || search_term == display[i].id)
                            {
                                row += "<tr><td>" + display[i].name + "</td><td>" + display[i].id + "</td><td>" + display[i].name + "</td><td>" + display[i].price + "</td><td>" + display[i].description + "</td><td>" + display[i].name + "</td><td><a href='/admins/edit_product/"+display[i].id+"'>edit</a> <a href='/admins/delete_prod/" + display[i].id + "'>delete</a></td></tr>"
                            }
                        }
                        $('#products').html(row);
                    }, 'json');
                    return false;
                });
            });
            </script>

</head>	
<body>
    <div class='container'>
        <div class='row' style='background-color: #22A7F0; border-bottom: 2px solid #BDC3C7'><br>
            <div class='col-md-3 pull-left' style='color: #FDE3A7; font-size: 16px; front-weight: 300'>Dashboard</div>
            <a class='col-md-3 pull-left' href='/admins/orders' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Orders</a>
            <a class='col-md-3 pull-left' href='/admins/products' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Products</a>
            <form class='col-lg-3 pull-right' action='/admins/products_json' method='post'>
                <input type='text' id='search_box' name='search' placeholder='Search' style='background-color: #22A7F0; color: #FDE3A7; border: 1px solid #6C7A89'>
                <input type='hidden' name='search_prods' value='submit'>
            </form>
            <a class='col-md-3 pull-right' href='/admins/logoff' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Log Off</a>
            <br><br>
        </div>
    </div>
    <div class='container' style='background-color: #A2DED0'>
        <div class='table'><br>
        <table id='products' class='table' style='background-color: #ECECEC; color: #6C7A89'>
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
                    echo "<tr><td><img src='/assets/photo_" . $product['id'] .".jpg' height='96' width='96'></td>";
                    echo "<td>" . $product['id'] . "</td>";
                    echo "<td>" . $product['name'] . "</td>";
                    echo "<td>" . $product['name'] . "</td>";
                    echo "<td>" . $product['name'] . "</td>";
                    echo "<td><a href='/admins/edit_product/{$product["id"]}'>edit</a> <a href='/products/delete/{$product["id"]}'>delete</a></td></tr>";
                    } ?>
        </tbody>
    </table>
    <a href="/products/add"><button>Add new Product</button></a>
</body>
</html>
