<?php 
include('templates/headerLogin.php');
?>


<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<style type="text/css" media="screen">
		.error { color: red; }
	

/* general button style */ 
button {
		border: 0;
	  width: 270px;
	  padding: 10px;
	  margin: 20px auto;
		-webkit-border-radius: 5px;
		   -moz-border-radius: 5px;
	   			  border-radius: 5px; 
	  
	  text-decoration: none;
	 	text-align: center;
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
	  font-size: 1.2em;
}
	
button:hover {
	  -webkit-transition: background-color 1s ease-in;  
	 	   -moz-transition: background-color 1s ease-in;  
	 	  	 -o-transition: background-color 1s ease-in;  
	     	    transition: background-color 1s ease-in; 
}

button:active {
		margin-top: 12px;
    margin-bottom: -2px;
}
	

/* Control the colour scheme */

.green {
		color: #FFF;
		background: #8bbc37;
	  -webkit-box-shadow: 0 3px 1px #64950d;
		   -moz-box-shadow: 0 3px 1px #64950d;
		   		  box-shadow: 0 3px 1px #64950d;
		   		  font-size:28px;
}
.green:hover {background: #85b237;}
.green:active {
	  -webkit-box-shadow: 0 10px 1px #64950d;
		   -moz-box-shadow: 0 1px 10px #64950d;
		     		box-shadow: 0 10px 1px #64950d;
}

.red {
	box-shadow: 3px 4px 0px 0px #8a2a21;
	background:linear-gradient(to bottom, #c62d1f 5%, #f24437 100%);
	background-color:#c62d1f;
	border-radius:18px;
	border:1px solid #d02718;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:28px;
	padding:7px 34px;
	text-decoration:none;
	text-shadow:0px 1px 0px #810e05;
}
.red:hover {
	background:linear-gradient(to bottom, #f24437 5%, #c62d1f 100%);
	background-color:#f24437;
}
.red:active {
	position:relative;
	top:1px;
}


.myButton {
	box-shadow:inset 0px 1px 5px 0px #a4e271;
	background:linear-gradient(to bottom, #89c403 5%, #77a809 100%);
	background-color:#89c403;
	border-radius:35px;
	border:9px solid #74b807;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:28px;
	font-weight:bold;
	padding:9px 30px;
	text-decoration:none;
	text-shadow:2px 1px 2px #528009;
}
.myButton:hover {
	background:linear-gradient(to bottom, #77a809 5%, #89c403 100%);
	background-color:#77a809;
}
.myButton:active {
	position:relative;
	top:10px;
}




	</style>
</head>
<body>
<?php // Script 3.3 handle_form.php 

include('templates/config.php');


$okay = true;


if(isset($_SESSION['unames'])){

	echo "<h3>Welcome back, ".$_SESSION['unames']."</h2>";
	echo "<h3>User ID: ".$_SESSION["user_id"]."<h3>";
	?>
<h2>Your account:</h2>
<div>
	<a href='order.php'><button class="green">My orders</button></a>

<a href='address.php'><button class="green">Shipping address</button></a>
<br/>

<br><h3>Sell your book here:</h3>
<br><a href='insert-product.php'><button class="myButton">Sell my book</button></a>
<br><a href='myStore.php'><button class="myButton">My book store</button></a>
<br><a href='sold.php'><button class="myButton">Sold</button></a>

<br><br><a href='logout.php'><button class="red"> Logout </button></a>
</div>
	
<?php
} else {


if ($okay){
		
	$email = $_POST['email'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$query = "SELECT id,password FROM user WHERE email = '$email'";
	$test = mysqli_query($con, $query) or die("could not search!");

	$count = mysqli_num_rows($test);
	if($count == 0){
		echo "<script>alert('username or password incorrect!')</script>";
		echo "<script>location.href='login.php'</script>";
	}

	else{
		while ($row = mysqli_fetch_array($test)){
			$current_password = $row['password'];
		}
	
	
	if(mysqli_num_rows(mysqli_query($con, $query)) > 0 ){

	$tow = mysqli_fetch_assoc(mysqli_query($con, $query));
	$user_id =  $tow['id'];
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
		echo "<script>location.href='login.php'</script>";
    }
	}

}
}

 // Return to PHP.
//include('templates/footer.html');
include('footer/footer.html'); // Include the footer.

?>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
