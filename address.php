<?php // Script 8.9 - register.php
/* This page lets people register for the site (in theory). */
// Set the page title and include the header file:
include('templates/headerLogin.php');
define('TITLE', 'Shipping Address');

include('templates/config.php');

if(isset($_POST['submito']))
{			

			$user_id = $_SESSION["user_id"];
			$contact_name = $_POST['contact_name'];
			$country = $_POST['country'];
			$street = $_POST['street'];
			$apt = $_POST['apt'];
			$state = $_POST['state'];
			$city = $_POST['city'];
			$zip = $_POST['zip'];
			$phone = $_POST['phone'];

$res = mysqli_query($con,"SELECT * FROM address WHERE user_id='$user_id'");

if(mysqli_num_rows($res)>0){

	$sql = "UPDATE address SET contact_name='$contact_name', country='$country', street_address='$street', apt_suite='$apt', state='$state', city='$city', zip='$zip', phone='$phone'";

  			$res = mysqli_query($con,$sql) or die("Could not update".mysqli_error($con));
  			echo "<script>alert('Your address is updated')</script>";
  			echo "<script>location.href='handle_login.php'</script>";
} else {
	$sql=mysqli_query($con,"insert into address(user_id,contact_name,country,street_address,apt_suite,state,city,zip,phone) values('$user_id','$contact_name','$country','$street','$apt','$state','$city','$zip','$phone')");
	echo "<script>alert('Your address is added')</script>";
	echo "<script>location.href='handle_login.php'</script>";

}
	

}

if(isset($_SESSION['unames'])){
// Print some introductory text:
print '<h2>Shipping Address</h2>
	<h4>Add a address to receive your package.</h4>';
	
// Create the form:
?>

<form action="address.php" method="post" class="form--inline">

	<p><label for="contact_name">Contact Name:</label><input type="text" name="contact_name" size="30" required></p>

	<p><label for="country">Country/Region:</label><input type="text" name="country" size="30" required></p>

	<p><label for="street">Street Address:</label><input type="text" name="street" size="40" placeholder="Street and number, P.O. box, c/o." required></p>
	<p><label for="apt"><span style="padding-left:96px"></label><input type="text" name="apt" size="40" placeholder="Apartment, suite, unit, building, floor, etc." required></p>

	<p><label for="state">State/Province/Region:</label><input type="text" name="state" size="30" required></p>

	<p><label for="city">City/Department:</label><input type="text" name="city" size="30" required></p>

	<p><label for="zip">Zip/Postal Code:</label><input type="text" name="zip" size="30" required></p>

	<p><label for="phone">Phone number:</label><input type="text" name="phone" size="30" required></p>

	<p><input type="submit" name="submito" value="Update" class="button--pill"></p>

</form>

<?php 

	$searchq = $_SESSION['user_id'];
	$query = mysqli_query($con,"SELECT * FROM `address` WHERE user_id LIKE '$searchq'") or die("could not search!");
	$count = mysqli_num_rows($query);
	if($count == 0){
		$output = 'There was no search results!';
		print $output;
	}else{
		while($row = mysqli_fetch_array($query)) {


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
  position:fixed; 
  right:120px; 
  top: 100px;
  font-size: 25px;
} 
</style>
</head>
<body>
		<address>
		<br>
		<h4>Your current address: </h4>
		<h5>Contact name: <?php print $contact;?> </h5>
		<?php print '<div>'.$street_.' '.$apt_suite.' </div>';?>
		<?php print '<div>'.$city_.', '.$state_.' '.$zip_.' </div>'; ?>
		<?php print $country_; ?><br>
		<h5>Phone:&nbsp;<?php print $phone_; ?></h5><br>
		</address>
<?php
} 
}
}
?>


<?php // Return to PHP.
//include('templates/footer.html');
include('footer/footer.html'); // Include the footer.
?>

