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
            $(document).ready(function() {
                $('#order_disp').change(function(){
                    $.get('/admins/order_display', function(display){
                       var row = "<thead><th>Order ID</th><th>Name</th><th>Date</th><th>Billing Address</th><th>Total</th><th>Status</th></thead>";
                       var disp_type = $('select[name="order_status"]').val();
                       if (disp_type == "Show All")
                       {
                            for (var i = 0; i <display.length; i++)
                            {
                                row += "<tr><td><a href='/admins/show/" + display[i].orders_id  + "'>"+ display[i].orders_id + "</a></td><td>" + display[i].name + "</td><td>" + display[i].created_at + "</td><td>" + display[i].billing_id + "</td><td>" + display[i].total + "</td><td><select><option value='" + display[i].status + "'>" + display[i].status + "</option><option value='In Process'>In Process</option><option value='Cancelled'>Cancelled</option><option value='Shipped'>Shipped</option> </select></td></tr>";
                            }    
                        }
                        else 
                        {
                            for (var i = 0; i < display.length; i++)
                            {
                                if (disp_type == display[i].status)
                                {
                                    row += "<tr><td><a href='/admins/show/" + display[i].orders_id  + "'>"+ display[i].orders_id + "</a></td><td>" + display[i].name + "</td><td>" + display[i].created_at + "</td><td>" + display[i].billing_id + "</td><td>" + display[i].total + "</td><td><select><option value='" + display[i].status + "'>" + display[i].status + "</option><option value='In Process'>In Process</option><option value='Cancelled'>Cancelled</option><option value='Shipped'>Shipped</option> </select></td></tr>";
                                }
                            }
                        }
                       $("#orders").html(row);
                    }, 'json');
                    return false; 
                });
            });
        </script>
</head>	
<body>
    <div id='header'>
        <h2>Dashboard</h2>
        <a href='/admins/orders'>Orders</a>
        <a href='/admins/products'>Products</a>
        <a href='/admins/logoff'>Log Off</a>
    </div>
    <form action='/admins/order_search' method='post'>
        <input type='text' name='search' placeholder='search'>
        <input type='hidden' name='display_type' value='submit'>
    </form>
    <form action='/admins/order_display' method='post'>
        <select name='order_status' id='order_disp'>
            <option value='Show All'>Show All</option>
            <option value='In Process'>In Process</option>
            <option value='Shipped'>Shipped</option>
        </select>
    </form>
    <!-- <ul> -->
    <?php /* var_dump($this->session->userdata);

    foreach($products as $product)
    { ?>
        <li>
            <p>Name: <?=$product['name']?></p>
            <p>Description: <?=$product['description']?></p>
            <p>Price: $<?=$product['price']?></p>
            <a href="/products/delete/<?=$product['id']?>">DELETE</a>
        </li>
    <?php } */ ?>
    <!-- </ul> -->
    <table id = 'orders'>
        <thead>
            <th>Order ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Billing Address</th>
            <th>Total</th>
            <th>Status</th>
        </thead>
        <tbody>
            <?php 
            // if(isset($order) && $order !== NULL)
            //     {
            //         echo "<tr><td>" . $order['id'] . "</td>";
            //         echo "<td>". $order['user_id'] . "</td>";
            //         echo "<td>". $order['created_at'] . "</td>";
            //         echo "<td>" . $order['user_id'] ."</td>";
            //         echo "<td>" . $order['total'] . "</td>";
            //         echo "<td><select><option value= {$order['status']}>{$order['status']}</option><option value='Order in process'>Order in Process</option><option value='Cancelled'>Cancelled</option><option value='Shipped'>Shipped</option> </select></td></tr>";
            //     }

            foreach ($orders as $order) {
                echo "<tr><td><a href='/admins/show/" . $order['orders_id'] . "'>" . $order['orders_id'] . "</a></td>";
                echo "<td>" . $order['name'] . "</td>";
                echo "<td>" . $order['created_at'] . "</td>";
                echo "<td>" . $order['billing_id'] . "</td>";
                echo "<td>" . $order['total'] . "</td>";
                echo "<td><select><option value= {$order['status']}>{$order['status']}</option><option value='In Process'>In Process</option><option value='Cancelled'>Cancelled</option><option value='Shipped'>Shipped</option> </select></td></tr>";
            } ?> 
        </tbody>
    </table>
    <a href="/products/add"><button>Add new Product</button></a>

</body>
</html>
