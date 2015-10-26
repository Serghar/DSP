<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
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
            <form action="/products/cart/<?=$product['id']?>" method='post'>
            <p>Quantity: <input type="number" name="quantity"></p>
            <input type="submit" value="Add to cart">
            </form>
        </li>
    <?php } ?>
    </ul>

</body>
</html>