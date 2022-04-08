<?php 
include('templates/headerLogin.php');
$message = "";
if(isset($_POST['add_to_cart_sear'])){ //check if form was submitted
  $input = $_POST['inputText']; //get input text
  $message = "Success! You entered: ".$input;
  echo "<script>location.href='search.php'</script>";
} 
else{
	"<script>location.href='index.php'</script>";

}

include('templates/config.php');
//$temp = mysqli_connect("localhost","root","","csc350");

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
				'item_author'       =>  $_POST["hidden_author"],
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
				'item_author'       =>  $_POST["hidden_author"],
				'item_condition'	=>	$_POST["hidden_conditions"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}
}
else{
	include('templates/search.html');
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
		<title>Webslesson Demo | Simple PHP Mysql Shopping Cart</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			<style>
		.payment{
			font-size:30px;
			color:red;
		}
	</style>
	</head>
	<body>
		<br />
		<div class="container">
			<br />
			<br />
			<br />
			<h3 class="payment" align="center">WE ARE DIRECTING YOU TO PAYPAL!!</h3><br />
			<br /><br />
		
			<div style="clear:both"></div>
			<br />
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
						<td><?php echo $values["item_publisher"];?></td>
						<td><?php echo $values["item_author"];?></td>
						<td><?php echo $values["item_edition"];?></td>
						<td><?php echo $values["item_isbn"];?></td>
						<td><?php echo $values["item_condition"];?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
							$shipping = $shipping + $values["item_shipping"];
							$final = $total + $shipping;
							$amount = number_format($final, 2);

					$query=mysqli_query($con,"select max(id) as pid from invoice");
					$result=mysqli_fetch_array($query);
	 				$invoice=$result['pid']+1;
	 				
	 				
					$userid = $_SESSION["user_id"];
					$seller_id = $values['item_seller_id'];
					$product_id = $values["item_id"];

					$productname = $values["item_name"];
					$author = $values["item_author"];
					$publisher = $values["item_publisher"];
					$edition = $values["item_edition"];
					$isbn = $values["item_isbn"];
					$quantity = $values["item_quantity"];
					$price = $values["item_price"];
					$shipping = $values["item_shipping"];
					$condition = $values["item_condition"];
					$status = "Order received";

					//$inv=mysqli_query($con,"insert into invoice(seller_id,buyer_id,product_id,product_name,shipping_cost,total) values('$seller_id','$userid','$product_id','$productname','$shipping','$amount')");

					$inv=mysqli_query($con,"insert into invoice(seller_id,buyer_id,product_id,product_name,shipping_cost,total) values('$seller_id','$userid','$product_id','$productname','$shipping','$amount')");

						$sql=mysqli_query($con,"insert into orders(buyer_id,seller_id,product_id,invoice_number,product_name,author,publisher,edition,isbn,quantity,price,shipping,conditions,status) values('$userid','$seller_id','$product_id','$invoice','$productname','$author','$publisher','$edition','$isbn','$quantity','$price','$shipping','$condition','$status')");
						

						foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $product_id)
			{
				unset($_SESSION["shopping_cart"][$keys]);
				//echo '<script>alert("Item Removed")</script>';
				//echo '<script>window.location="cart.php"</script>';  //index
			}
		}
					//	$sql=mysqli_query($con,"insert into orders(user_id,buyer_id,product_id,invoice_number,product_name,author,publisher,edition,isbn,quantity,price,shipping,conditions,status) values('$userid','$seller_id','$product_id','$invoice','$productname','$author','$publisher','$edition','$isbn','$quantity','$price','$shipping','$condition','$status')");

						
						
						//$inv=mysqli_query($con,"insert into invoice(seller_id,user_id,product_id,product_name,shipping_cost,total) values('$seller_id','$userid','$product_id','productname','$shipping','$amount')");
						}
						/*foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $product_id)
			{
				unset($_SESSION["shopping_cart"][$keys]);
				//echo '<script>alert("Item Removed")</script>';
				//echo '<script>window.location="cart.php"</script>';  //index
			}
		}*/
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

				</table>
			<?php
			 }else{
			 	print "The shopping cart is empty!";
			 } ?>

		</div>
		</div>
	</div>
	<br />
	</body>
</html>

<form name="paypalpay" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="manhuang1996@gmail.com">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="Total">
<input type="hidden" name="amount" value="<?php echo $final; ?>">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submitos" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<script>
window.onload = function(){
  document.forms['paypalpay'].submit();
}
</script>