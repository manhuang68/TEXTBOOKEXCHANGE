 <?php

include('templates/config.php');
// Create connection
if(isset($_POST["deletion"]))
{
	$id = $_GET['id'];

	print $id;

// sql to delete a record

$sql = "DELETE FROM products WHERE id='$id'";

if (mysqli_query($con,$sql) === TRUE) {



	echo "<script>alert('Product deleted successfully!')</script>";
	echo "<script>location.href='myStore.php'</script>";
    echo "Record deleted successfully";

} else {
    echo "Error deleting record: " . $con->error;
}
}
//$conn->close();

?> 