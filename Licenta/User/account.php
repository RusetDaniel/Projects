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

// Search account by id
$id = $_SESSION['id'];
$sql = " SELECT username,email,phone from users WHERE id = '$id'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

// Store the account informations in to the variables
$username = $row['username'];
$email = $row['email'];
$phone = $row['phone'];
$id = "";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>My Account</title>
   <style>
     <?php include 'Style.css'; ?>
   </style>
</head>
<body>

  <div class="sidebar">
    <h1>Menu</h1>
    <ul>
      <li><a class="menubtn" href="home.php">Home</a></li>
      <li><a id="current" href="account.php">Account</a></li>
      <li><a class="menubtn" href="Sentform.php">Sent Form</a></li>
      <li><a class="menubtn" href="Myforms.php">My Forms</a></li>
      <li><a class="menubtn" href="Myproducts.php">My Products</a></li>
      <li><a id="logout" href="logout.php">Logout</a></li>
    </ul>
  </div>


  <div class="container">

    <div class="account-box">

      <div class="account-group">
        <label for="">User Name</label><br>
        <span><?php echo $username; ?></span>
      </div>

      <div class="account-group">
        <label for="">E-mail Adress</label><br>
        <span><?php echo $email; ?></span>
      </div>

      <div class="account-group">
        <label for="">Phone Number</label> <br>
        <span><?php echo $phone; ?></span>
      </div>

      <a id="changepassword-btn" href="ChangeAccData/cPassword.php" target="_blank">Change password</a>


    </div>

  </div>


</body>
</html>
