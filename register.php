<?php // Script 8.9 - register.php
/* This page lets people register for the site (in theory). */
// Set the page title and include the header file:
define('TITLE', 'Register');
include('templates/headerLogin.php');

// Print some introductory text:
print '<h2>Registration Form</h2>
	<p>By creating an account, you agree to the Textbookexchange.com Free Membership Agreement and Privacy Policy </p>';
	
// Create the form:
?>
<form action="handle_reg.php" method="post" class="form--inline">

	<p><label for="first_name">First Name:</label><input type="text" name="firstn" size="20"></p>

	<p><label for="lastn">Last Name:</label><input type="text" name="lastn" size="20" required></p>

	<p><label for="email">Email Address:</label><input type="email" name="email" size="20" required></p>

	<p><label for="password">Password:</label><input type="password" name="password" size="20" required></p>
	<p><label for="password2">Confirm Password:</label><input type="password" name="password2" size="20" required></p>

	<p><input type="submit" name="submit" value="Create Account" class="button--pill"></p>

</form>


<?php include('footer/footer.html'); // Need the footer. ?>
