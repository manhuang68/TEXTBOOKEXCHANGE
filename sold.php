<?php
include('templates/headerLogin.php');
include('templates/config.php');
?>


<?php


$producto = '';
if(isset($_SESSION['unames'])){
	$searchq = $_SESSION["user_id"];
	$query = mysqli_query($con,"SELECT * FROM `orders` WHERE seller_id = '$searchq'") or die("could not search!");
	$count = mysqli_num_rows($query);
	if($count == 0){
		$output = 'No one bought your books yet!';
	?><h3> <?php	print $output; ?> </h3><?php
	}else{ 
	?>	
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Table V01</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	
	
<!--===============================================================================================-->
<body>
</head>
<h2>Sold record</h2>
	 			<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table class="table table-bordered">
						<thead>
							<tr class="table100-head">
								<th width="5%" class="column1">Date</th>
								<th width="10%" class="column2">Order number</th>
								<th width="25%" class="column3">Product name</th>
								<th width="10%" class="column4">ISBN</th>
								<th width="10%" class="column5">Price</th>
								<th width="5%" class="column6">Shipping</th>
								<th width="5%" class="column7">Condition</th>
								<th width="5%" class="column8">Status</th>
								<th width="5%" class="column9">Update Status</th>
								<th width="15%" class="column10">Address</th>
							</tr>
						</thead>
							<tbody>
	<?php	
		while($row = mysqli_fetch_array($query)) {
			
			$date = $row['date_entered'];
			$invoices = $row['invoice_number'];
			$product_name = $row['product_name'];
			$author = $row['author'];
			$publisher = $row['publisher'];
			$edition = $row['edition'];
			$isbn = $row['isbn'];
			$quantity = $row['quantity'];
			$price = $row['price'];
			$shipping = $row['shipping'];
			$condition = $row['conditions'];
			$status = $row['status'];
			$id = $row['id'];
			//$buyer_id = $row['user_id'];

			$buyer_id = $row['buyer_id'];

		    $qu = mysqli_query($con,"SELECT * FROM `address` WHERE user_id = '$buyer_id'") or die("could not search!");
			$coun = mysqli_num_rows($qu);
			if($coun == 0){
					$usern = mysqli_query($con,"SELECT * FROM `user` WHERE id = '$buyer_id'") or die("could not search!");
					$cou = mysqli_num_rows($usern);
					if($cou==0){
						$contact = 'There is no username';
					}else{ while($rowa = mysqli_fetch_array($usern)){
						$contact = $rowa['firstname'];
						$street_ = 'The buyer did not';
						$apt_suite = ' add the address.';
						$city_ = 'Contact ';
						$state_ = 'this ';
						$zip_ = 'email: ';
						$country_ = $rowa['email'];
						$phone_ = 'for the address.';
					}
				}

			}else{   while($row = mysqli_fetch_array($qu))
			{	

			$contact = $row['contact_name'];
			$country_ = $row['country'];
			$street_ = $row['street_address'];
			$apt_suite = $row['apt_suite'];
			$state_ = $row['state'];
			$city_ = $row['city'];
			$zip_ = $row['zip'];
			$phone_ = $row['phone'];
			}
		}

			$producto = '<div>'.$product_name.' '.$author.' '.$publisher.' '.$edition.'</div>';  
            $invoice = str_pad( "$invoices", 4, "0", STR_PAD_LEFT );
	?> 		

						
								<tr>
									<td class="column1"><?php echo $date; ?></td>
									<td class="column2"><?php echo $invoice; ?></td>
									<td class="column3"><?php echo $producto; ?></td>
									<td class="column4"><?php echo $isbn; ?></td>
									<td class="column5">$<?php echo $price; ?></td>
									<td class="column6">$<?php echo $shipping; ?></td>
									<td class="column7"><?php echo $condition; ?></td>
									<td class="column8"><?php echo $status; ?></td>
									<td class="column9">
										<form method="post" action="update.php?action=update&id=<?php echo $id; ?>">
											<div class="controls">
										<select  name="condiciones"  id="productAvailability" class="span8 tip" required>
											<option value="">Select</option>
											<option value="Received">Order Received</option>
											<option value="Shipped">Shipped</option>
											<option value="canceled">Canceled</option>
											<option value="Finished">Finished</option>
										</select>
										<input type="submit" name="update" style="margin-top:1px;" class="btn btn-success" value="Update" />
									</div>
									</form>
								</td>
								<td class="column10">		
									<h5>Contact name: <?php print $contact;?> </h5>
									<?php print '<div>'.$street_.' '.$apt_suite.' </div>';?>
									<?php print '<div>'.$city_.' '.$state_.' '.$zip_.' </div>'; ?>
									<?php print $country_; ?><br>
									<?php print $phone_; ?><br>
								</td>
								</tr>
				<?php
		}				
								?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
	<!--===============================================================================================-->	
<?php	
/*		
if(isset($_POST["update"]))
{	
	$condicion = $_POST['condiciones'];
	$id = $_GET['id'];
	echo "<script>alert('username or password incorrect!')</script>";
	print $id;
	print $condicion;

	$res = mysqli_query($con,"SELECT * FROM orders WHERE id='$id'");

if(mysqli_num_rows($res)>0){

	$sql = "UPDATE orders SET status='$condicion'";

  			$res = mysqli_query($con,$sql) or die("Could not update".mysqli_error($con));
  			echo "<script>alert('Your address is updated')</script>";
  	
// sql to delete a record


}
//$conn->close();
}*/
	}
}


// Return to PHP.
//include('templates/footer.html');
include('footer/footer.html'); // Include the footer.


?>
