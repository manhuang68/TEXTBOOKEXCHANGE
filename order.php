<?php
include('templates/headerLogin.php');
include('templates/config.php');
?>


<?php


$producto = '';
if(isset($_SESSION['unames'])){
	$searchq = $_SESSION["user_id"];
	//$query = mysqli_query($con,"SELECT * FROM `orders` WHERE user_id = '$searchq'") or die("could not search!");

	$query = mysqli_query($con,"SELECT * FROM `orders` WHERE buyer_id = '$searchq'") or die("could not search!");

	$count = mysqli_num_rows($query);
	if($count == 0){
		$output = 'There is no order!';
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
<h2>Orders record</h2>
	 			<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table class="table table-bordered">
						<thead>
							<tr class="table100-head">
								<th width="10%" class="column1">Date</th>
								<th width="15%" class="column2">Invoice number</th>
								<th width="40%" class="column3">Product name</th>
								<th width="10%" class="column4">ISBN</th>
								<th width="10%" class="column5">Price</th>
								<th width="5%" class="column6">Shipping</th>
								<th width="5%" class="column7">Condition</th>
								<th width="10%" class="column8">Status</th>
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

	}
}

//include('templates/footer.html');
include('footer/footer.html'); // Include the footer.

?>
