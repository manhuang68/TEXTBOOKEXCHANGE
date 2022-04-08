<?php
include('templates/headerLogin.php');
include('templates/config.php');

if(isset($_SESSION['unames'])){

	
//mysql_connect("localhost","root","password") or die("could not connect");


//mysql_connect("localhost","root","OOOO");
//mysql_select_db("csc350") or die("could not find db!");
$output = '';

	$searchq = $_SESSION["user_id"];
	$query = mysqli_query($con,"SELECT * FROM `products` WHERE seller_id LIKE '$searchq'") or die("could not search!");
	$count = mysqli_num_rows($query);
	if($count == 0){
		$output = 'You do not have any products in Stock!';
		?><h3> <?php	print $output; ?> </h3><?php
	}else{
		while($row = mysqli_fetch_array($query)) {

			?>
			<style>
			img.img-responsive{
				  height: 50%;
  					width: 90%;
			}
		    </style>
			<div class="col-md-4">
				<form method="post" action="deleteOrder.php?action=delete&id=<?php echo $row["id"]; ?>">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="productimages/<?php echo $row["productImage1"]; ?>" class="img-responsive" width=400px height=400px/><br />

						<h4 class="text-info"><?php echo $row["title"]; ?></h4>
						<h4 class="text-info"><?php echo $row["author"]; ?></h4>
						<h4 class="text-info">Edition: <?php echo $row["edition"]; ?></h4>
						<h4 class="text-info">I.S.B.N: <?php echo $row["isbn"]; ?></h4>
						<h4 class="text-danger">$ <?php echo $row["productprice"]; ?></h4>
						<h4 class="text-info">Shipping: $ <?php echo $row["shippingcost"]; ?></h4>


						<input type="hidden" name="hidden_name" value="<?php echo $row["title"]; ?>" />
						<input type="hidden" name="hidden_author" value="<?php echo $row["author"]; ?>" />
						<input type="hidden" name="hidden_edition" value="<?php echo $row["edition"]; ?>" />
						<input type="hidden" name="hidden_isbn" value="<?php echo $row["isbn"]; ?>" />

						<input type="hidden" name="hidden_seller_id" value="<?php echo $row["seller_id"]; ?>" />

						<input type="hidden" name="hidden_publisher" value="<?php echo $row["publisher"]; ?>" />
						<input type="hidden" name="hidden_shipping" value="<?php echo $row["shippingcost"]; ?>" />
						<input type="hidden" name="hidden_conditions" value="<?php echo $row["conditions"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["productprice"]; ?>" />
				

						
						<input type="submit" name="deletion" style="margin-top:5px;" class="btn btn-success" value="Delete" />
   
					</div>
				</form>
			</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<?php


		}
	}

}
?>
<div style="clear:both"></div>
<?php

include('footer/footer.html'); // Include the footer.

?>
