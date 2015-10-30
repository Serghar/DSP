<?php
//get cart size
$cartSize = count($this->session->userdata('cart'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MICROPRISM</title>
    <!-- <link rel="stylesheet" type="text/css" href="assets/main.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script type='text/javascript'>
        $(document).ready(function() {
            $('form').submit(function() {
                $.get('/admins/products_json', function(display)
                {    
                    var row = "<div class='container'><div class='row'><br><ul style='inline-block'>";
                    var product_term = $('input[name="search_product"]').val();
                    for (var i = 0; i < display.length; i++)
                    {
                        if(product_term == display[i].name) 
                        {
                            row += "<li class='product'><a href='/products/show/" + display[i].id + "'><img src='/assets/photo_" + display[i].id + ".jpg' height=140 width=140><p>Price: " + display[i].price + "</p><p style='font-size: 16px'><strong>" + display[i].name + "</strong></p></a></li></ul>"
                        }
                    }
                    $('#searching').html(row);
                }, 'json');
                return false
            });
            $('#all_cats').click(function(){
                $.get('/products/show_cats_json', function(res){
                    console.log(res);
                    var categories = " ";
                    for (var i = 0; i < res.length; i++)
                    {
                        categories += "<li id='the_cats'><a id='show_cat' href='/products/display_prod/" + res[i].id + "'>" + res[i].name + "</a></li>";
                    }
                    $('#the_cats').html(categories);
                }, 'json');
            return false
            });
            // $('#show_cat').click(function(res){
            //     $.get('/admins/products_json', function(display)
            //     {
            //         // var cats = "<div class='container'><div class='row'><br><ul style='inline-block'>";
            //         // // var value = $(res.target.name).val();
            //         // for (var i = 0; i < display.length; i++)
            //         // {
            //         //     if (res.id == display[i].name)
            //         //     {
            //         //         cats += "<li class='product'><a href='/products/show/" + display[i].id + "'><img src='/assets/photo_" + display[i].id + ".jpg' height=140 width=140><p>Price: " + display[i].price + "</p><p style='font-size: 16px'><strong>" + display[i].name + "</strong></p></a></li></ul>";
            //         //     }
            //         // }
            //         // $('#searching').html(cats);
            //     // }, 'json');
            //     return false
            // });
            //     return false;
        });
    </script>
</head>
<body>
    <div class='containter' style='background-color: #E4F1FE'>
        <div class='row'>
            <div class='col-md-1'>
                <ul class='nav nav-stacked fixed' style='border: 0px solid black; position: relative; text-align: left' id='sidebar'>
                    <li>
                        <form action='/admins/products_json' id='search_prod' method='post'>
                            <input type='text' name='search_product' placeholder='photo name'>
                            <button name='search' value='submit'><i class='fa fa-search'></i></button>
                        </form><br>
                    </li>
                    <li><strong>Categories: </strong></li>
                    <?php foreach ($categories as $category) {
                        echo "<div id='show_cat'<li id='the_cats'><a href='/products/display_prod/" . $category['id'] . "'>" . $category['name'] . "</a></li></div>";
                    } ?>
                    <button id='all_cats'>See all categories</button>
                </ul>
            </div><br>
            <div class='col-md-1 col-md-offset-1' style='font-size: 24px'><strong>Products</strong></div><br>
            <div class='col-sm-9 col-sm-offset-1'>
            <ul id='searching' style='display: inline-block'>
            <?php foreach($products as $product)
            { ?>
                <li class="product">
                    <a href="/products/show/<?=$product['id']?>">
                        <img src='/assets/photo_<?= $product['id']?>.jpg' height=140 width=140>
                        <p>Price: $<?=$product['price']?></p>
                        <p style='font-size: 16px'><strong><?=$product['name']?></strong></p>  
                    </a>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
</body>
</html>