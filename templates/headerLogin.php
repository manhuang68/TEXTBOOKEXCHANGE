<html>
  <style>
    .a{
      font-size:20px;
      font-family:Comic Sans MS;
      color: white;
    }
    .b{
      font-size:20px;
      color:red;
    }
    .siteHeader{
      background-color: #484848;
    }
  </style>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="HandheldFriendly" content="True">
  <title>TEXTBOOK EXCHANGEs</title>
  <link rel="stylesheet" type="text/css" media="screen"
href="css/concise.min.css" />
  <link rel="stylesheet" type="text/css" media="screen" href="css/masthead.css" />
</head>
<body style="background-color:lightgray;">
  <header container class="siteHeader">
    <div row>
      <h1  ><a column="4" class="logo" href="index.php">TEXTBOOK EXCHANGE</a></h1>
        <nav column="8" class="nav">
          <ul>
            <?php 
            session_start();
            if(isset($_SESSION["unames"])){
            ?>
            <li><a class="a" href="testing.php">Textbook</a></li>     
            <li><a class="a" href="cart.php">Cart</a></li>
            <li><a class="a" href="handle_login.php"> <?php print $_SESSION['unames']; ?> </a></li>
            <li><a class="b" href="logout.php">Sign out</a></li>
            <?php }else { ?>

            <li><a class="a" href="testing.php">Textbooks</a></li>
            <li><a class="a" href="login.php">Login</a></li>
            <li><a class="a" href="register.php">Register</a></li>
          <?php } ?>
          </ul>
        </nav>
    </div>
  </header>
  <main container class="siteContent">
</body>
</html>
<html>