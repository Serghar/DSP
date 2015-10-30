<!DOCTYPE html>
<html lang="en">
<head>
	<style type="text/css">
		#container{
			margin: 10px;
		}
	</style>
	<script>
		$(document).ready(function(){
			$(document).on("change", "#shiptobilling-checkbox", function() {
				if($(this).is(":checked")){
					$("#shipping").hide("slow");
					$("[id^='shipping_']").each(function(){
						data=$(this).attr("id")
						tmpID = data.split('shipping_');
						$(this).val($("#billing_"+tmpID[1]).val());
					})
				}else{
					$("#shipping").show("slow");
					$("[id^='shipping_']").each(function(){
						$(this).val("");
					})					
				}
			});

			var zip_max_chars = 4;
			var ccn_max_chars = 15;
			var cvv_max_chars = 3;

			$('#shipping_zipcode_field').keydown( function(e){
			    if ($(this).val().length >= zip_max_chars) { 
			        $(this).val($(this).val().substr(0, zip_max_chars));
			    }
			});
			$('#billing_zipcode_field').keydown( function(e){
			    if ($(this).val().length >= zip_max_chars) { 
			        $(this).val($(this).val().substr(0, zip_max_chars));
			    }
			});

			$('#security_code_field').keydown( function(e){
			    if ($(this).val().length >= cvv_max_chars) { 
			        $(this).val($(this).val().substr(0, cvv_max_chars));
			    }
			});

			$('#card_number_field').keydown( function(e){
			    if ($(this).val().length >= ccn_max_chars) { 
			        $(this).val($(this).val().substr(0, ccn_max_chars));
			    }
			});
		});
	</script>

</head>
<hr>
<body>
	<form action = "users/purchase_process" method = "post">
		<div class="row">
	  		<div class="col-md-3 col-md-offset-2">
				<h1> Billing Information </h1>
				<div id="billing">
					<div class="form-group">
						<label for="billing_first_name_field">First Name</label>
						<input type = "text" class="form-control" id="billing_first_name_field" name="billing_first_name">
					</div>
					<div class="form-group">
						<label for="billing_last_name_field">Last Name</label>
						<input type = "text" class="form-control" id="billing_last_name_field" name="billing_last_name">
					</div>
					<div class="form-group">
						<label for="billing_Address_name_field">Address</label>
						<input type = "text" class="form-control" id = "billing_address_field" name = "billing_address" placeholder="Address Line 1">
						<input type = "text" class="form-control" id = "billing_address_2_field" name = "billing_address_2" placeholder="Address Line 2 (Optional)">
					</div>
					<div class="form-group">
						<label for="billing_city_name_field">City</label>
						<input type = "text" class="form-control" id = "billing_city_field" name = "billing_city">
					</div>
					<div class="form-group">
						<label for="billing_state_name_field">State</label>
						<select class="form-control" id = "billing_state_field" name = "billing_state">
							<option>Select State/Region</option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District Of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option>
						</select>
					</div>
					<div class="form-group">
						<label for="billing_zipcode_name_field">Zipcode</label>
						<input type = "text" class="form-control" id = "billing_zipcode_field" name = "billing_zipcode">
					</div>
				</div>
			</div>
			<div class="col-md-3 col-md-offset-2">
				<h1> Shipping Information </h1>
				<p>
					<input id = "shiptobilling-checkbox" type = "checkbox" name = "same_info">
					Same as Billing?
				</p>
				<div id="shipping">
					<div class="form-group">
						<label for="shipping_first_name_field">First Name</label>
						<input type = "text" class="form-control" id="shipping_first_name_field" name="shipping_first_name">
					</div>
					<div class="form-group">
						<label for="shipping_last_name_field">Last Name</label>
						<input type = "text" class="form-control" id="shipping_last_name_field" name="shipping_last_name">
					</div>
					<div class="form-group">
						<label for="shipping_Address_name_field">Address</label>
						<input type = "text" class="form-control" id = "shipping_address_field" name = "shipping_address" placeholder="Address Line 1">
						<input type = "text" class="form-control" id = "shipping_address_2_field" name = "shipping_address_2" placeholder="Address Line 2 (Optional)">
					</div>
					<div class="form-group">
						<label for="shipping_city_name_field">City</label>
						<input type = "text" class="form-control" id = "shipping_city_field" name = "shipping_city">
					</div>
					<div class="form-group">
						<label for="shipping_state_name_field">State</label>
						<select class="form-control" id = "shipping_state_field" name = "shipping_state">
							<option>Select State/Region</option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District Of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option>
						</select>	
					</div>
					<div class="form-group">
						<label for="shipping_zipcode_name_field">Zipcode</label>
						<input type = "text" class="form-control" id = "shipping_zipcode_field" name = "shipping_zipcode">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<h1>Payment Information</h1>
				<div id="payment">
					<div class="form-group row">
						<label for="card_number_field" class="col-md-3" style="padding-right:0px">Credit Card Number</label>
						<div class="col-md-5">
							<input type = "text" class="form-control" id="card_number_field"  name = "card_number">
						</div>
						<label for="security_code_field" class="col-md-2" style="padding-right:0px">CVV Code</label>
						<div class="col-md-2" style="padding-left:0px">
							<input type = "text" class="form-control" id="security_code_field"  name = "security_code">
						</div>
					</div>
					<div class="form-group">
						<label for="expiration_date_field">Expiration Date</label>
						<div class="row">
							<div class="col-md-4">
								<select class="form-control" id="expiration_date_field"  name = "expiration_month">
									<option>Select a Month</option><option value="01">01 - January</option><option value="02">02 - Febuary</option><option value="03">03 - March</option><option value="04">04 - April</option><option value="05">05 - May</option><option value="06">06 - June</option><option value="07">07 - July</option><option value="08">08 - August</option><option value="09">09 - September</option><option value="10">10 - October</option><option value="11">11 - November</option><option value="12">12 - December</option>
								</select>
							</div>
							<div class='col-md-3'>
								<select class="form-control" id="expiration_date_field"  name = "expiration_year">
									<?PHP for($i=date("Y"); $i<=date("Y")+9; $i++)
										  	if($year == $i)
												echo "<option value='$i' selected>$i</option>";
											else
												echo "<option value='$i'>$i</option>";
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="email_field">Email</label>
						<input type = "text" class="form-control" id="email_field"  name = "email">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-1 col-md-offset-7" style="margin-top: 20px; margin-bottom: 50px" >
			<button class="btn btn-success btn-lg" style="width:200px; height:80px">Place Order</button>
		</div>
	</form>
	
</body>
</html>

