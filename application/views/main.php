<?php
//This is the main display page
var_dump($this->session->userdata);
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
        <div id="main-content">
            <ul>
            <?php foreach($products as $product)
            { ?>
                <li>
                    <p>Name: <?=$product['name']?></p>
                    <p>Description: <?=$product['description']?></p>
                    <p>Price: $<?=$product['price']?></p>
                    <form action="/products/cart/<?=$product['id']?>" method='post'>
                    <p>Quantity: <input type="number" name="quantity"></p>
                    <input type="submit" value="Add to cart">
                    </form>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
</body>
</html>