<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
//CHECK if user has acces to current page,if not redirect him to login page
elseif ($_SESSION["user_level"] !== 2) {
  header("location: login.php");
  exit;
}


require_once "connect.php";


 ?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Welcome!</title>
     <style media="screen">
       <?php include "Style.css" ?>
     </style>
   </head>
   <body>

     <div class="sidebar">
       <h1>Menu</h1>
       <ul>
         <li><a id="current" href="home.php">Home</a></li>
         <li><a class="menubtn" href="users.php">Users</a></li>
         <li><a class="menubtn" href="Register.php">Register New Admin</a></li>
         <li><a id="logout" href="logout.php">Logout</a></li>
       </ul>
     </div>

     <div class="container">
       <div class="page-header">
           <h1 id="greeting">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome!</h1>
       </div>
     </div>

   </body>
 </html>
