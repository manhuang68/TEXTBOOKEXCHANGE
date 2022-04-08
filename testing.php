<?php 
include('templates/headerLogin.php');
//include('templates/header.html');
//include('templates/search.html');
//session_start();
include('templates/search.html');

include('templates/config.php');
/*
if($_POST["hidden_seller_id"]==$_SESSION["user_id"])
	{
		echo '<script>alert("You can not buy from yourself!")</script>';
		echo '<script>window.location="testing.php"</script>';
	
	}else
	*/

	if(isset($_SESSION["unames"]))
{
	//include('templates/headerLogin.php');
if(isset($_POST["add_to_cart"]))
{

	if(isset($_SESSION["shopping_cart"]))
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
				echo '<script>window.location="testing.php"</script>';  //index
			}
		}
	}
}
//include('login.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Books on sale</title>
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
			<h3 align="center">Books on sale!</h3><br />
			<br />
			<?php
				$query = "SELECT * FROM products ORDER BY id ASC";
				$result = mysqli_query($con, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{

				?>
			<div class="col-md-4">
				<form method="post" action="cart.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:5px solid #333; background-color:#f1f1f1; border-radius:30px; padding:15px;" align="center">
						<img src="productimages/<?php echo $row["productImage1"]; ?>" class="img-responsive" width=400px height=400px /><br />

						<h4 class="text-info"><?php echo $row["title"]; ?></h4>
						<h4 class="text-info"><?php echo $row["author"]; ?></h4>
						<h4 class="text-info">Edition: <?php echo $row["edition"]; ?></h4>
						<h4 class="text-info">I.S.B.N: <?php echo $row["isbn"]; ?></h4>
						<h4 class="text-danger">$ <?php echo $row["productprice"]; ?></h4>
						<h4 class="text-info">Shipping: $ <?php echo $row["shippingcost"]; ?></h4>

						

						<input type="text" name="quantity" value="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["title"]; ?>" />
						<input type="hidden" name="hidden_author" value="<?php echo $row["author"]; ?>" />
						<input type="hidden" name="hidden_edition" value="<?php echo $row["edition"]; ?>" />
						<input type="hidden" name="hidden_isbn" value="<?php echo $row["isbn"]; ?>" />

						<input type="hidden" name="hidden_seller_id" value="<?php echo $row["seller_id"]; ?>" />

						<input type="hidden" name="hidden_publisher" value="<?php echo $row["publisher"]; ?>" />
						<input type="hidden" name="hidden_shipping" value="<?php echo $row["shippingcost"]; ?>" />
						<input type="hidden" name="hidden_conditions" value="<?php echo $row["conditions"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["productprice"]; ?>" />
						<?php

						 if(isset($_SESSION["unames"])){  ?>
						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
    <?php }else
	{  ?>
		<input type="submit" name="loginpage" style="margin-top:5px;" class="btn btn-success" value="LOGIN" />

	<?php } ?>
					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			<div style="clear:both"></div>
			<br/>
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="testing.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>

					<?php
					$total = $total + ($values["item_quantity"] * $values["item_price"]);
					/*if(isset($_POST['add_to_cart'])){
					$query=mysqli_query($temp,"select max(id) as pid from invoice");
					$result=mysqli_fetch_array($query);
	 				$invoice=$result['pid']+1;
					
					$userid = $_SESSION["user_id"];
					$seller_id = 8;
					//$values["seller_id"];
					$product_id = $values["item_id"];
					$productname = $values["item_name"];
					$quantity = $values["item_quantity"];
					$price = $values["item_price"];
					print $productname;
						$sql=mysqli_query($temp,"insert into temporders(user_id,seller_id,product_id,invoice_number,product_name,quantity,price) values('$userid','$seller_id','$product_id','$invoice','$productname','$quantity','$price')");
					}*/
					} else{
					?>
					<tr>
						<td colspan="10" align="middle"><h3>The cart is empty!</h3></td>
					</tr>
					<?php } ?>
				</table>
<style>
	.payb{float: right;}
</style>
									<form class="payb" action="cart.php" method="post" target="_top">
<input type="submit" name="submit" value="My shopping cart" class="button--pill">
</form>
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