<?php
//get cart size
$cartSize = count($this->session->userdata('cart'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to our site</title>
    <link rel="stylesheet" type="text/css" href="assets/main.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">  -->
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
                        <div class="product-info">
                            <img src='/assets/photo_<?= $product['id']?>.jpg' height=140 width=140>
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