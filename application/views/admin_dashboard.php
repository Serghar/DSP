<?php if(!$this->session->userdata('admin'))
	{
		redirect('/');
	} ?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Admin Dashboard</title>
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
                                row += "<tr><td><a href='/admins/show/" + display[i].id  + "'>"+ display[i].id + "</a></td><td>" + display[i].first_name + "</td><td>" + display[i].created_at + "</td><td>" + display[i].street + " " + display[i].city + " " + display[i].state + " " + display[i].zipcode + "</td><td>" + display[i].total + "</td><td><select><option value='" + display[i].status + "'>" + display[i].status + "</option><option value='In Process'>In Process</option><option value='Cancelled'>Cancelled</option><option value='Shipped'>Shipped</option> </select></td></tr>";
                            }    
                        }
                        else 
                        {
                            for (var i = 0; i < display.length; i++)
                            {
                                if (disp_type == display[i].status)
                                {
                                    row += "<tr><td><a href='/admins/show/" + display[i].id  + "'>"+ display[i].id + "</a></td><td>" + display[i].first_name + "</td><td>" + display[i].created_at + "</td><td>" + display[i].street + " " + display[i].city + " " + display[i].state + " " + display[i].zipcode + "</td><td>" + display[i].total + "</td><td><select><option value='" + display[i].status + "'>" + display[i].status + "</option><option value='In Process'>In Process</option><option value='Cancelled'>Cancelled</option><option value='Shipped'>Shipped</option> </select></td></tr>";
                                }
                            }
                        }
                       $("#orders").html(row);
                    }, 'json');
                    return false; 
                });
                $('#admin_search').submit(function(){
                    $.get('/admins/order_display', function(display){
                        console.log(display);
                        var row = "<thead><th>Order ID</th><th>Name</th><th>Date</th><th>Billing Address</th><th>Total</th><th>Status</th></thead>";
                       var term = $('input[name="search"]').val();
                       for (var i = 0; i < display.length; i++)
                       {
                            if (term == display[i].first_name || term == display[i].id || term == display[i].zipcode)
                            {
                                row += "<tr><td><a href='/admins/show/" + display[i].id  + "'>"+ display[i].id + "</a></td><td>" + display[i].first_name + "</td><td>" + display[i].created_at + "</td><td>" + display[i].street + " " + display[i].city + " " + display[i].state + " " + display[i].zipcode + "</td><td>" + display[i].total + "</td><td><select><option value='" + display[i].status + "'>" + display[i].status + "</option><option value='In Process'>In Process</option><option value='Cancelled'>Cancelled</option><option value='Shipped'>Shipped</option> </select></td></tr>";
                            }                       
                       }
                       $('#orders').html(row);
                    }, 'json');
                    return false;
                })
            });
        </script>
</head>	
<body>
    <div class='container-fluid'>
        <div class='row' style='background-color: #22A7F0; border-bottom: 2px solid #BDC3C7'>
            <br>
            <div class='col-md-2 pull-left' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Dashboard</div>
            <form class='col-lg-2 pull-right' action='/admins/order_search' id='admin_search' method='post'>
                <input type='text' name='search' placeholder='search' style='background-color: #22A7F0; color: #FDE3A7; border: 1px solid #6C7A89'>
                <input type='hidden' name='display_type' value='submit'>
            </form>
            <a class='col-md-2 pull-left' href='/admins/orders' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Orders</a>
            <a class='col-md-2 pull-left' href='/admins/products' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Products</a>
            <a class='col-md-2 pull-right' href='/admins/logoff' style='color: #FDE3A7; font-size: 16px; font-weight: 300'>Log Off</a>
            <br><br>
        </div>
    </div>
    <div class='container-fluid' style="background-color: #A2DED0; padding-bottom: 400px">
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
                    echo "<tr><td><a href='/admins/show/" . $order['id'] . "'>" . $order['id'] . "</a></td>";
                    echo "<td>" . $order['first_name'] . "</td>";
                    echo "<td>" . $order['created_at'] . "</td>";
                    echo "<td>" . $order['street'] . " " . $order['city'] . " " . $order['state'] . " " . $order['zipcode'] . "</td>";
                    echo "<td> $" . $order['total'] . "</td>";
                    echo "<td><form id='status_change' action='/admins/update_order' method='post'><select onchange='this.form.submit()' name={$order['id']}><option value= {$order['status']}>{$order['status']}</option><option value='In Process'>In Process</option><option value='Cancelled'>Cancelled</option><option value='Shipped'>Shipped</option> </select></form></td></tr>";
                } ?> 
            </tbody>
        </table>
        <a href="/products/add"><button type="button" class="btn btn-primary">Add new Product</button></a>
        </div>
    </div>
</body>
</html>