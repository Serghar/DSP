<?php if(!$this->session->userdata('admin'))
	{
		redirect('/');
	} ?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Admin Dashboard</title>
<!--     <link rel='stylesheet' href='/assets/bootstrap/css/bootstrap.min.css'>
    <link rel='stylesheet' href='/assets/bootstrap/css/bootstrap.css'>
    <link rel='stylesheet' href='/assets/bootstrap/css/bootstrap-theme.css'> -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
                // $('#status_change').change(function(){
                //     $.post('/admins/update_order/', function(
                //         ''))
                // })
            });
        </script>
</head>	
<body>
    <div class='container'>
        <div class='row' style='background-color: #22A7F0'>
            <br>
            <div class='col-md-3 pull-left' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Dashboard</div>
            <form class='col-lg-3 pull-right' action='/admins/order_search' method='post'>
                <input type='text' name='search' placeholder='search' style='background-color: #22A7F0; color: #FDE3A7; border: 1px solid #6C7A89'>
                <input type='hidden' name='display_type' value='submit'>
            </form>
            <a class='col-md-3 pull-right' href='/admins/orders' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Orders</a>
            <a class='col-md-3 pull-right' href='/admins/products' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Products</a>
            <a class='col-md-3 pull-right' href='/admins/logoff' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Log Off</a>
            <br><br>
        </div>
    </div>
    <div class='container' style="background-color: #A2DED0">
        <div class='row'>
            <br>
            <form class='col-lg-4 pull-right' action='/admins/order_display' method='post'>
                <select name='order_status' id='order_disp'>
                    <option value='Show All'>Show All</option>
                    <option value='In Process'>In Process</option>
                    <option value='Shipped'>Shipped</option>
                </select>
            </form>
        </div>
        <div class='table'><br>
        <table id = 'orders' class='table' style="background-color: #ECECEC; color: #6C7A89">
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
                foreach ($orders as $order) {
                    echo "<tr><td><a href='/admins/show/" . $order['orders_id'] . "'>" . $order['orders_id'] . "</a></td>";
                    echo "<td>" . $order['name'] . "</td>";
                    echo "<td>" . $order['created_at'] . "</td>";
                    echo "<td>" . $order['billing_id'] . "</td>";
                    echo "<td>" . $order['total'] . "</td>";
                    echo "<td><form action='/admins/update_order/' method='post'><select id='status_change'><option value= {$order['status']}>{$order['status']}</option><option value='In Process'>In Process</option><option value='Cancelled'>Cancelled</option><option value='Shipped'>Shipped</option> </select></form></td></tr>";
                } ?> 
            </tbody>
        </table>
        <a href="/products/add"><button>Add new Product</button></a>
        </div>
    </div>
</body>
</html>
