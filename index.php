<?php // Script 8.4 - index.php

include('templates/headerLogin.php');

?>			
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bgimg {
  background-image: url('templates/books.jpg');
  height: 100%;
  background-position: center;
  background-size: cover;
  position: relative;
  color: white;
  font-family: "Courier New", Courier, monospace;
  font-size: 25px;
}

.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}

.bottomleft {
  position: absolute;
  bottom: 0;
  font-family: "Times New Roman", Times, serif;
  left: 16px;
}
.search{
  color: black;

}
.middle {
  position: absolute;
  top: 38%;
  left: 30%;
  transform: translate(-50%, -50%);
  text-align: center;
}

hr {
  margin: auto;
  width: 60%;
}

.glowa {
  color: yellow;
  position: absolute;
  bottom: 0;
  font-family: "Times New Roman", Times, serif;
  left: 16px;
  bottom: 12%;
  font-size: 25px;
  
  text-align: center;
  -webkit-animation: glow 1s ease-in-out infinite alternate;
  -moz-animation: glow 1s ease-in-out infinite alternate;
  animation: glow 1s ease-in-out infinite alternate;
}

@-webkit-keyframes glow {
  from {
    text-shadow: 0 0 10px yellow, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
  }
  
  to {
    text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px yellow, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
  }
</style>
<body>

<div class="bgimg">
  <div class="topleft">
    <p>Our books are tax free!</p>
  </div>
  <div class="middle">
    <h2>Welcome to<br/>Textbook Exchange!</h2>
    <hr>
    <p>Search your textbook here!</p> 
    <div class="search">
    <?php include('templates/search.html'); ?>
    </div>
  </div>

  <div class="glowa">
    <h5>Do you want to sell your textbook?</h5>
    <h5>Register a new account and sell any books without paying any fees!</h5>
  </div>
</div>

</body>
</html>
<?php // Return to PHP.
include('footer/footer.html'); // Include the footer.
?>