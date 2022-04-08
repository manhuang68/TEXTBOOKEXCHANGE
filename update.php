<?php
include('templates/config.php');

if(isset($_POST["update"]))
{	
	$condicion = $_POST['condiciones'];
	$id = $_GET['id'];
	print $id;
	print $condicion;

	$res = mysqli_query($con,"SELECT * FROM orders WHERE id='$id'");

if(mysqli_num_rows($res)>0){

	$sql = "UPDATE orders SET status='$condicion' WHERE id='$id'";

  			$res = mysqli_query($con,$sql) or die("Could not update".mysqli_error($con));
  			echo "<script>alert('The status of this order is updated')</script>";
  			echo "<script>location.href='sold.php'</script>";
  	

}
//$conn->close();
}
?>