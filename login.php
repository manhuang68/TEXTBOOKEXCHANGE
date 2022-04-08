<?php // Script 8.8 - login.php
/* This page lets people log into the site (in theory). */

// Set the page title and include the header file:
define('TITLE', 'Sign in');
include('templates/headerLogin.php');

// Print some introductory text:
print '<h2>Login Form</h2>
	<p>Welcome to Textbook Exchange!</p>';

// Check if the form has been submitted:


	print '<form action="handle_login.php" method="post" class="form--inline">
	<p><label for="email">Email Address:</label><input type="email" name="email" size="30" required></p>
	<p><label for="password">Password:</label><input type="password" name="password" size="30"></p>
	<p><input type="submit" name="submit" value="Log In!" class="button--pill"></p>
	</form>';

?>
<h5>&nbsp;&nbsp;Don't have an account?&nbsp;&nbsp;<a class="b" href="register.php">Join Us!</a></h5>
<?php


include('footer/footer.html'); // Need the footer.
?>
