<?php
//This is the main display page
//var_dump($this->session->userdata);
//var_dump($products);

//get cart size
$cartSize = count($this->session->userdata('cart'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to our site</title>
    <link rel="stylesheet" type="text/css" href="assets/main.css">
</head>
<body>
    <div id="container">
        <div id="header">
            <p>Header area</p>
            <a href="/cart">Your Shopping Cart (<?=$cartSize?>)</a>
        </div>
        <div id="sidebar">
            <p>This is the sidebar/search area. Stuff still needs to be added here</p>
        </div>
        <div id="main-content">
            <h1>Products</h1>
            <ul>
            <?php foreach($products as $product)
            { ?>
                <a href="/products/show/<?=$product['id']?>">
                    <li class="product">
                        <div class="product-info" style="background-image: url('assets/temp.jpg')">
                            <p>Price: $<?=$product['price']?></p>
                        </div>
                        <h2><?=$product['name']?></h2>
                    </li>
                </a>
            <?php } ?>
            </ul>
        </div>
    </div>
</body>
</html>