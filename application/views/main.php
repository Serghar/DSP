<?php
//get cart size
$cartSize = count($this->session->userdata('cart'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MICROPRISM</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script type='text/javascript'>
        $(document).ready(function() {
            $('form').submit(function() {
                $.get('/admins/products_json', function(display)
                {    
                    var row = "<div class='container'><div class='row'><br><ul style='inline; list-style-type: none'>";
                    var product_term = $('input[name="search_product"]').val();
                    console.log(product_term);
                    for (var i = 0; i < display.length; i++)
                    {
                        if(product_term == display[i].name) 
                        {
                            row += "<li class='product'><a href='/products/show/" + display[i].id + "'><img src='/assets/photo_" + display[i].id + ".jpg' height=140 width=140><p>Price: " + display[i].price + "</p><p style='font-size: 16px'><strong>" + display[i].name + "</strong></p></a></li></ul>"
                        }
                        else if (product_term == "")
                        {   
                            row = "";
                            row += "<br><ul style='inline-block' class='col-md-10'>";
                            row += "<li class='product' style='display: inline-block; padding: 20px; width: 250px; height: 250px' class='product'><a href='/products/show/" + display[i].id + "'><img src='/assets/photo_" + display[i].id + ".jpg' height=140 width=140><p>Price: " + display[i].price + "</p><p style='font-size: 16px'><strong>" + display[i].title + "</strong></p></a></li></div>";
                        }
                    }
                    $('#searching').html(row);
                }, 'json');
                return false
            });
            // $('#all_cats').click(function(){
            //     $.get('/products/show_cats_json', function(res){
            //         var categories = " ";
            //         for (var i = 0; i < res.length; i++)
            //         {
            //             categories += "<li id='the_cats'><a class='this_cat' id='" + res[i].name + "' href='/products/display_prod/" + res[i].id + "'>" + res[i].name + "</a></li>";
            //         }
            //         console.log(categories);
            //         $('#the_cats').html(categories);
            //     }, 'json');
            // return false
            // });
            $('.this_cat').on("click", function(res){
                $.get('/products/prod_by_category', function(display)
                {
                    var cats = "<br><ul style='inline-block' class='col-md-10'>";
                    console.log(res.target.id);
                    console.log(display);
                    var value = res.target.id
                    for (var i = 0; i < display.length; i++)
                    {
                        if (res.target.id == display[i].name)
                        {
                            cats += "<li class='product' style='display: inline-block; padding: 20px; width: 250px; height: 250px' class='product'><a href='/products/show/" + display[i].id + "'><img src='/assets/photo_" + display[i].id + ".jpg' height=140 width=140><p>Price: " + display[i].price + "</p><p style='font-size: 16px'><strong>" + display[i].title + "</strong></p></a></li></div>";
                        }
                    }
                    cats += "</ul>";
                    $('#searching').html(cats);
                }, 'json');
                return false;
            });
        });
    </script>
</head>
<body>
    <div class='containter' style='background-color: #E4F1FE; padding-bottom: 400px'>
        <div class='row'>
            <div class='col-md-1'>
                <ul class='nav nav-stacked fixed' style='border: 0px solid black; position: relative; text-align: left' id='sidebar'>
                    <li>
                        <div class='input-box' style='width: 170px; margin-left: 20px; margin-top: 15px'>
                        <form action='/admins/products_json' id='search_prod' method='post'>
                            <input type='text' name='search_product' style='width: 120px' placeholder='photo name'>
                            <button name='search' value='submit'><i class='fa fa-search'></i></button>
                        </form></div><br>
                    </li>
                    <li style='text-align: center; margin-left: 40px'><strong>Categories: </strong></li>
                    <?php foreach ($categories as $category) {
                        echo "<div id='show_cat'><li id='the_cats' style='text-align: left; margin-left: 40px'><a class='this_cat' id='" . $category['name'] . "' href='/products/display_prod/" . $category['id'] . "'>" . $category['name'] . "</a></li></div>";
                    } ?>
                </ul>
            </div><br>
            <div class='col-md-1 col-md-offset-1' style='font-size: 24px; margin-left: 122px'><strong>Products</strong></div><br>
            <div>
                <ul id='searching' class='col-md-10 col-md-offset-1' style='list-style-type: none; display: inline'>
                <?php foreach($products as $product)
                { ?>
                    <li style='display: inline-block; padding: 20px; width: 250px; height: 250px' class="product">
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
    </div>
</body>
</html>