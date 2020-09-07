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
     <title>Users</title>
     <style media="screen">
       <?php include "Style.css" ?>
     </style>
   </head>
   <body>

     <div class="sidebar">
       <h1>Menu</h1>
       <ul>
         <li><a class="menubtn" href="home.php">Home</a></li>
         <li><a id="current" href="users.php">Users</a></li>
         <li><a class="menubtn" href="Register.php">Register New Admin</a></li>
         <li><a id="logout" href="logout.php">Logout</a></li>
       </ul>
     </div>

     <div class="container">

       <div class="display">

         <form class="searchusers" method="post">
           <input type="text" name="nume" placeholder="Search...">
           <input type="submit" id="search-button" name="SearchUsers" value="Search">
         </form>

         <?php
         if (isset($_POST['SearchUsers'])) {
           $_SESSION['searchusers'] = $_POST["nume"];
           include "userstable.php";
         }elseif (isset($_SESSION['searchusers'])) {
           include "userstable.php";
         }
          ?>
       </div>

     </div>

     <script>

     function deleteUser(user_id,btn)
     {
       var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
         if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
         {
           var i = btn.parentNode.parentNode.rowIndex;
           document.getElementById("usersstable").deleteRow(i);
           alert(xmlhttp.responseText);
         }
     };
     xmlhttp.open("GET", "deleteUser.php?user_id="+user_id, true);
     xmlhttp.send();

     }

     </script>
   </body>
 </html>
