<?php // Script 8.4 - index.php
/* This is the home page for this site.
It uses templates to create the layout. */

// Include the header:

include('templates/headerLogin.php');
/*
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'shopping');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}*/
// Leave the PHP section to display lots of HTML:
?>

<!doctype html>
<html>
<head>
	<meta http-eqiv="Content-Type" content="text/html"; charset="utf-8">
	<title>Searching</title>
</head>
<body>
	<h1>Search any textbook here!</h1><br/>
	<form action="search.php" method="post" >
		<input type="text" name="search" placeholder="Enter the tittle or the ISBN of the book to search your Books..." >
		<input type="submit" value=">>" />
	</form>

</body>
</html>

<!DOCTYPE html>
<html>
	<head>
		<title>Webslesson Demo | Simple PHP Mysql Shopping Cart</title>
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


	<section class="section featured-product inner-xs wow fadeInUp">
		<h3 class="section-title"></h3>

			<?php
include('templates/config.php');
//mysql_connect("localhost","root","OOOO");
//mysql_select_db("csc350") or die("could not find db!");
$output = '';
if(isset($_POST['search'])){
	$searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
	$query = mysqli_query($con,"SELECT * FROM `products` WHERE title LIKE '%$searchq%' OR isbn LIKE '%$searchq%'") or die("could not search!");
	$count = mysqli_num_rows($query);
	if($count == 0){
		$output = 'There was no search results!';
		print $output;
	}else{
		while($row = mysqli_fetch_array($query)) {


			$fname = $row['title'];
			$lname = $row['isbn'];
			$id = $row['id'];

			$output .= '<div>'.$fname.' '.$lname.'</div>';
			?>

			<div class="col-md-4">
				<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:15px; padding:15px;" align="center">
				<form method="post" action="cart.php?action=add&id=<?php echo $row["id"]; ?>">

						<img src="productimages/<?php echo $row["productImage1"]; ?>" class="img-responsive" width=400px height=400px/><br />

						<h4 class="text-info"><?php echo $row["title"]; ?></h4>
						<h4 class="text-info"><?php echo $row["author"]; ?></h4>
						<h4 class="text-info">Edition: <?php echo $row["edition"]; ?></h4>
						<h4 class="text-info">I.S.B.N: <?php echo $row["isbn"]; ?></h4>
						<h4 class="text-danger">Price: $ <?php echo $row["productprice"]; ?></h4>
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
		<input type="submit" name="add_to_cart_search" style="margin-top:5px;" class="btn btn-success" value="LOGIN" />
	<?php } ?>


				</form>
				<audio controls>
				  <source src="c" type="audio/ogg" />
				  <source src="audio/<?php echo $row["title"]; ?>" type="audio/mpeg" />
				</audio>

					</div>
			</div>




				<?php

		}
	}
}

?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			<div style="clear:both"></div>






<?php // Return to PHP.
//include('templates/footer.html');
include('footer/footer.html'); // Include the footer.
?>
