
<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
   header("location: login.php");
   exit;
}
//CHECK if user has acces to current page,if not redirect him to login page
elseif ($_SESSION["user_level"] !== 0) {
 header("location: login.php");
 exit;
}

// CONNECT to the DataBase
require_once "connect.php";

 ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home</title>
<style>
  <?php include 'Style.css'; ?>
</style>
</head>
<body>
    <div class="sidebar">
      <h1>Menu</h1>
      <ul>
        <li><a id="current" href="home.php">Home</a></li>
        <li><a class="menubtn" href="account.php">Account</a></li>
        <li><a class="menubtn" href="Sentform.php">Sent Form</a></li>
        <li><a class="menubtn" href="Myforms.php">My Forms</a></li>
        <li><a class="menubtn" href="Myproducts.php">My Products</a></li>
        <li><a id="logout" href="logout.php">Logout</a></li>
      </ul>
    </div>

    <div class="container">
      <div class="boxes-home">
        <h3>Welcome <?php echo $_SESSION["username"] ?> to our website!</h3>
        <p class="home-text">Here on the home page you can find information
          about website features,where to find them and how to use them.</p>
      </div>

      <div class="boxes-home">
        <h3>You have a product that must be sent under warranty?</h3>
        <p class="home-text">Visit the <a href="Sentform.php">Sent Form</a> page.On this page you will find a formular box, where you have to enter the name of the product
,your country and city,the place where the product was purchased,the serial number of the product
,the date of purchase,the length of the warranty,a scan image of the product invoice and a scan image of the warranty of the product.
After the form is a sent,our personal will check if the informations are correct,and will
confirm or decline it.If confirmed,the courier will come to pick up the product,
and bring it to our service.</p>
      </div>

      <div class="boxes-home">
        <h3>Wana see your forms status ?</h3>
          <p class="home-text">Check the <a href="Myforms.php">My Forms</a> page, here you can find a table with the forms submited and details about them,like the name of the product,serial number
of the product, the date it was sent and the current status of the form.</p>
      </div>

      <div class="boxes-home">
        <h3>Wana see your products status ?</h3>
        <p class="home-text">Check the <a href="Myproducts.php">My Products</a> page,here you can find a table with your registerd products and details about them,like the name of the product,serial number
          of the product, the date it was purchased,the length of the warranty and the current status of the product.</p>
      </div>

      <div class="boxes-home">
        <h3>Wana see your account information ?</h3>
        <p class="home-text">Check the <a href="account.php">Account</a> page,there you can see your user name,email address and phone number,also from there you
        have the posibility to change your password,if needed. </p>
      </div>


    </div>
</body>
</html>
