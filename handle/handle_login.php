<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<style type="text/css" media="screen">
		.error { color: red; }
	</style>
</head>
<body>
<?php // Script 3.3 handle_form.php 

$dbc = mysqli_connect('localhost','root','','csc350');

//$query = "SELECT id,password FROM user WHERE email = '$email'";
session_start();


// This page receives the data from feedback.html.
// It will receive: title, name, email, response, comments, and submit in $_POST.
$okay = true;
// Create shorthand versions of the variables:
/*if(empty($_POST['password'])){
	print '<p class="error">Your confirmed password</p>';
	$okay = false;
}

if(empty($_POST['email'])){
	print '<p class="error">Enter your email</p>';
	$okay = false;
}*/
// Create shorthand versions of the variables:
if(isset($_SESSION['unames'])){
	echo "<h1>Welcome ".$_SESSION['unames']."</h1>";
	echo "<a href='prueba.php'>Product</a><br>";
	echo "<br><a href='logout.php'><input type=button value=logout name=logout></a>";
	echo "<br><a href='prueba.html'><input type=button value=try name=try></a>";
	echo "<br><a href='insert-product.php'><input type=button value=inser name=insert></a>";
	print $_SESSION['user_id'];
	//$user_id =  $row['lastname'];
		//echo $user_id;
//	$dbc = mysqli_connect('localhost','root','','csc350');
	//$sql_query = "select id from user where email = '$email'";


} else {


if ($okay){
		
	$email = $_POST['email'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$query = "SELECT id,password FROM user WHERE email = '$email'";
	$test = mysqli_query($dbc, $query);
	if ($r = $test){
		while ($row = mysqli_fetch_array($r)){
			$current_password = $row['password'];
			//$user_id =  $row['id'];
		}
		print '<p>Password retrieved successfully.</p>';
		
	} else {
		print '<p style="color: red;">Could not retrieve email/password due to an error:<br>' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	}
	//
	if(mysqli_num_rows(mysqli_query($dbc, $query)) > 0 ){

	$tow = mysqli_fetch_assoc(mysqli_query($dbc, $query));
//$name = $row["email"]; 
	$user_id =  $tow['id'];
	echo $user_id;
	$_SESSION["user_id"] = $user_id;
	//echo "Welcome: Buyer";
	}



	$verify = password_verify($current_password, $password);
	if (password_verify($current_password, $password)){
		print '<p>Login Successful!</p>';
		
		$_SESSION['unames']=$email;
		echo "<script>location.href='handle_login.php'</script>";
		

	} else {
		echo "<script>alert('username or password incorrect!')</script>";
		echo "<script>location.href='signin.php'</script>";

/*
		print '<p style="color: red">Incorrect password! $current_password</p>';
		print "<div>Thank you, for your posting:
<p>The password you entered $password and the current password is $current_password</p></div>";
*/	}
	
if(mysqli_num_rows($test) > 0 ){

$rr = mysqli_fetch_assoc($test);
//$name = $row["email"]; 
$user_id =  $rr['id'];

}


//unset($connection);

}
}
/*
$sql_query = "select id from user where email like '$email'";
$result = mysqli_query($dbc, $sql_query);

if(mysqli_num_rows($result) > 0 ){

$row = mysqli_fetch_assoc($result);
//$name = $row["email"]; 
$user_id =  $row['id'];
echo $user_id;
echo "Welcome: Buyer";
}*/


/*
$uname="admin";
$pwd="admin";


session_start();

if(isset($_SESSION['unames'])){
	echo "<h1>Welcome ".$_SESSION['unames']."</h1>";
	echo "<a href='product.php'>Product</a><br>";
	echo "<br><a href='logout.php'><input type=button value=logout name=logout></a>";
	echo "<br><a href='index.php'><input type=button value=try name=try></a>";
	echo "<br><a href='insert-product.php'><input type=button value=inser name=insert></a>";
}
else{
	if($_POST['unames']==$uname && $_POST['pwd']==$pwd){

	$_SESSION['unames']=$uname;
	$_SESSION['prueba']=$uname;

	echo "<script>location.href='welcome.php'</script>";
	}else
	{
		echo "<script>alert('username or password incorrect!')</script>";

		echo "<script>location.href='login.php'</script>";
	}

*/

?>
</body>
</html>