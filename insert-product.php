
<?php

include('templates/headerLogin.php');
include('templates/config.php');


if(strlen($_SESSION['unames'])==0)
	{	
header('location:index.php');
}
else{
	
if(isset($_POST['submit']))
{	
	$seller_email=$_SESSION['unames'];
	$seller_id= $_SESSION["user_id"];
	
	$title= $_POST['title'];
	$author= $_POST['author'];
	$publisher = $_POST['publisher'];
	$isbn= $_POST['isbn'];
	$edition = $_POST['edition'];
	$productprice=$_POST['productprice'];
	$shippingcost=$_POST['productShippingcharge'];
	$condition = $_POST['condition'];
	$productimage1=$_FILES["productimage1"]["name"];

//for getting product id
	/*
$query=mysqli_query($con,"select max(id) as pid from products");
	$result=mysqli_fetch_array($query);
	 $productid=$result['pid']+1;
	$dir="productimages/$productid";
if(!is_dir($dir)){
		mkdir("productimages/".$productid);
	}*/

	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"productimages/".$_FILES["productimage1"]["name"]);
	
$sql=mysqli_query($con,"insert into products(seller_email,seller_id,title,author,publisher,isbn,edition,productprice,shippingcost,conditions,productImage1) values('$seller_email','$seller_id','$title','$author','$publisher','$isbn','$edition','$productprice','$shippingcost','$condition','$productimage1')");
/*
$sql=mysqli_query($con,"insert into products(category,subCategory,productName,productCompany,productPrice,productDescription,shippingCharge,productAvailability,productImage1,productImage2,productImage3,productPriceBeforeDiscount) values('$category','$subcate','$productname','$productcompany','$productprice','$productdescription','$productscharge','$productavailability','$productimage1','$productimage2','$productimage3','$productpricebd')");
*/
$_SESSION['msg']="Product Inserted Successfully !!";
//$_SESSION['test']= $subcate;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Insert Product</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

   <script>
function getSubcat(val) {
	$.ajax({
	type: "POST",
	url: "get_subcat.php",
	data:'cat_id='+val,
	success: function(data){
		$("#subcategory").html(data);
	}
	});
}
function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>	


</head>
<body>


	
	<div class="wrapper">
		<div class="container">
			<div class="row">

			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Insert a product</h3>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))

									{
										echo "<script>alert('Product Inserted Successfully !')</script>";
										echo "<script>location.href='insert-product.php'</script>";
									?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">



<div class="control-group">
<label class="control-label" for="basicinput">Title</label>
<div class="controls">
<input type="text"    name="title"  placeholder="Enter Title of the book (Max. 26 character)" class="span8 tip" maxlength="26" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Author</label>
<div class="controls">
<input type="text"    name="author"  placeholder="Enter the Author" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Publisher</label>
<div class="controls">
<input type="text"    name="publisher"  placeholder="Enter Publisher" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">International Standard Book Number (I.S.B.N)</label>
<div class="controls">
<input type="text"    name="isbn"  placeholder="Enter I.S.B.N" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Edition</label>
<div class="controls">
<input type="text"    name="edition"  placeholder="Enter the edition of the book" class="span8 tip" required>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Product Price</label>
<div class="controls">
<input type="number" step="0.01" min="0" max="9999.99"  name="productprice"  placeholder="Enter Product Price  (You can enter any price less than $10000)" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Product Shipping Charge</label>
<div class="controls">
<input type="number"  step="0.01" min="0" max="9999.99"  name="productShippingcharge"  placeholder="Enter Product Shipping Charge (You can enter any charge less than $10000)" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Condition</label>
<div class="controls">
<select   name="condition"  id="productAvailability" class="span8 tip" required>
<option value="">Select</option>
<option value="New">New</option>
<option value="Used">Used</option>
</select>
</div>
</div>



<div class="control-group">
<label class="control-label" for="basicinput">Product Image</label>
<div class="controls">
<input type="file" name="productimage1" id="productimage1" value="" class="span8 tip" required>
</div>
</div>


	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Insert</button>
											</div>
										</div>
									</form>
							</div>
						</div>


	
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>
<?php } 

 // Return to PHP.
//include('templates/footer.html');
include('footer/footer.html'); // Include the footer.

?>