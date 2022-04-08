<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Registration</title>
	<style type="text/css" media="screen">
		.error {color: red;}
	</style>
</head>
<body>
	<h1>Registration Results</h1>
<?php // Script 3.3 handle_form.php 

// This page receives the data from feedback.html.
// It will receive: title, name, email, response, comments, and submit in $_POST.
$okay = true;
// Create shorthand versions of the variables:
include('templates/config.php');

if (empty($_POST['email'])){
	print '<p class="error">Please enter your email address!</p>';
		echo "<script>alert('Please enter your email address!')</script>";
		echo "<script>location.href='register.php'</script>";
		$okay = false;
}

if (empty($_POST['firstn'])){
	print '<p class="error">Please enter your First name!</p>';
		$okay = false;
}

if (empty($_POST['lastn'])){
	print '<p class="error">Please enter your Last name!</p>';
		$okay = false;
}

if (empty($_POST['password'])){
	print '<p class="error">Please enter your password!</p>';
		$okay = false;
}

if ($_POST['password'] != $_POST['password2']){
	print '<p class = "error">Different password.</p>';
		echo "<script>alert('You entered different password!')</script>";
		echo "<script>location.href='register.php'</script>";
	$okay = false;
}

	$searchq = $_POST['email'];
	$query = mysqli_query($con,"SELECT * FROM `user` WHERE email = '$searchq'") or die("could not search!");
	$count = mysqli_num_rows($query);
	if($count == 0){
		$$okay = true;
	}else{
		while($row = mysqli_fetch_array($query)) {
			$okay = false;
			echo "<script>alert('The email already exist!')</script>";
			echo "<script>location.href='register.php'</script>";
		}
	}

if ($okay){
	
	$name = $_POST['firstn'];
	$lastn = $_POST['lastn'];
 	$password = $_POST['password'];
	$email = $_POST['email'];
 //	$password2 = $_POST['password2'];

	//$dbc = mysqli_connect('localhost','root','','csc350','3306');
	$query = "INSERT INTO user (email, firstname, lastname, password, active_ind, date_entered)
	VALUES ('$email','$name','$lastn','$password','Y',NOW())";
	$result =mysqli_query($con, $query);

	if ($result === TRUE){
		print '<p>Registration completed successfully.</p>';
		echo '<script>alert("Registration completed successfully!")</script>';
		echo '<script>window.location="login.php"</script>';
	} else {
		print '<p style="color: red;">Could not register due to error:<br>'. mysqli_error($con) .'.</p><p>The query being run was: ' . $query . '</p>';
		echo '<script>window.location="register.php"</script>';
	}
	mysqli_close($con);
}
?>
</body>
</html>