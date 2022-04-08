<?php 
include('templates/headerLogin.php');
include('templates/config.php');
$message = "";
if(isset($_POST['add_to_cart_sear'])){ //check if form was submitted
  $input = $_POST['inputText']; //get input text
  $message = "Success! You entered: ".$input;
  echo "<script>location.href='search.php'</script>";
} 
else{
	"<script>location.href='index.php'</script>";

}

if(isset($_SESSION["unames"]))
{
	//include('templates/headerLogin.php');
if(isset($_POST["add_to_cart"]))
{

	if($_POST["hidden_seller_id"]==$_SESSION["user_id"])
	{
		echo '<script>alert("You can not buy from yourself!")</script>';
		echo '<script>window.location="testing.php"</script>';
	
	}elseif(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_author'       =>  $_POST["hidden_author"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"],
				'item_edition'		=>	$_POST["hidden_edition"],
				'item_isbn'		    =>	$_POST["hidden_isbn"],
				'item_seller_id'	=>	$_POST["hidden_seller_id"],
				'item_publisher'	=>	$_POST["hidden_publisher"],
				'item_shipping'		=>	$_POST["hidden_shipping"],
				'item_condition'	=>	$_POST["hidden_conditions"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_author'       =>  $_POST["hidden_author"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"],
			'item_edition'		=>	$_POST["hidden_edition"],
			'item_isbn'		    =>	$_POST["hidden_isbn"],
			'item_seller_id'	=>	$_POST["hidden_seller_id"],
			'item_publisher'	=>	$_POST["hidden_publisher"],
			'item_shipping'		=>	$_POST["hidden_shipping"],
			'item_condition'	=>	$_POST["hidden_conditions"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}
$searchq = $_SESSION['user_id'];
	$query = mysqli_query($con,"SELECT * FROM `address` WHERE user_id LIKE '$searchq'") or die("could not search!");
	$count = mysqli_num_rows($query);
	if($count == 0){
		$output = '<h3>There is no shipping address</h3>';print $output;
		?>
		<br><a href='address.php'><button class="ship" style="color:yellow;" class="green">Add a Shipping address</button></a>
		<?php
	}else{
		while($row = mysqli_fetch_array($query)){ 
			$contact = $row['contact_name'];
			$country_ = $row['country'];
			$street_ = $row['street_address'];
			$apt_suite = $row['apt_suite'];
			$state_ = $row['state'];
			$city_ = $row['city'];
			$zip_ = $row['zip'];
			$phone_ = $row['phone'];

			?>
<html>
<head>
<style>
address { 
  display: block;
  font-style: italic;
  position:static; 
  right:120px; 
  top: 100px;
  font-size: 25px;
} 
.ship{
	color:yellow;
}
</style>
</head>
<body>
		<address>
		<h2>Your current Shipping address: </h4>
		<h3>Contact name: <?php print $contact;?> </h5>
		<?php print '<div>'.$street_.' '.$apt_suite.' </div>';?>
		<?php print '<div>'.$city_.', '.$state_.' '.$zip_.' </div>'; ?>
		<?php print $country_; ?><br>
		<h3>Phone:&nbsp;<?php print $phone_; ?></h3>
		<a href='address.php'><button class="ship" class="green">Change Shipping address</button></a>
		</address>
<?php

		}

	}

}
else{
	echo "<script>location.href='login.php'</script>";
}
if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="cart.php"</script>';  //index
			}
		}
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Shopping Cart</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
				<style>
			img.img-responsive{
				  height: 50%;
  					width: 90%;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<br />
			<h3 align="center">Your Shopping Cart</h3><br />
			<br />
			<div style="clear:both"></div>
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="35%">Item Name</th>
						<th width="10%">Publisher</th>
						<th width="10%">Author</th>
						<th width="5%">Edition</th>
						<th width="10%">ISBN</th>
						<th width="5%">Condition</th>
						<th width="5%">Quantity</th>
						<th width="5%">Price</th>
						<th width="10%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						$shipping = 0;
						$amount = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_publisher"]; ?></td>
					    <td><?php echo $values["item_author"];?></td>
						<td><?php echo $values["item_edition"] ;?></td>
						<td><?php echo $values["item_isbn"];?></td>
						<td><?php echo $values["item_condition"];?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$<?php echo $values["item_price"]; ?></td>
						<td>$<?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
							$shipping = $shipping + $values["item_shipping"];
							$amount = $total + $shipping;
							$amount = number_format($amount, 2);
							$_SESSION["pay"] = $amount;


						}
					?>
					<tr>
						<td colspan="8" align="right">Shipping cost</td>
						<td align="right">$ <?php echo number_format($shipping, 2); ?></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="8" align="right">Total</td>
						<td align="right">$ <?php echo $amount; ?></td>
						<td></td>
					</tr>

						<?php
				 }else{  ?>
				 	<tr>
						<td colspan="10" align="middle"><h3>The cart is empty!</h3></td>
					</tr>
			<?php	 } ?>
				</table>

<style>
	.pa{float: right;}
</style>
<?php 
if(!empty($_SESSION["shopping_cart"])){   ?>
									<form class="pa" action="paypalpayment.php" method="post" target="_top">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
	<?php	}	?>
		</div>
		</div>
	</div>
	<br />
	</body>
</html>


<?php // Return to PHP.
//include('templates/footer.html');
include('footer/footer.html'); // Include the footer.
?>