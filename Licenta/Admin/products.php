<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
//CHECK if user has acces to current page,if not redirect him to login page
elseif ($_SESSION["user_level"] !== 1) {
  header("location: login.php");
  exit;
}

require_once "connect.php";
// unset($_SESSION['searchform']); unset($_SESSION['searchuser']);

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Products</title>
    <style>
    <?php include 'Style.css' ?>
</style>
  </head>
  <body>

    <div class="sidebar">
      <h1>Menu</h1>
      <ul>
        <li><a class="menubtn" href="home.php">Home</a></li>
        <li><a class="menubtn" href="Newforms.php">New Forms</a></li>
        <li><a class="menubtn" href="Oldforms.php">Old Forms</a></li>
        <li><a id="current"  href="products.php">Products</a></li>
        <li><a class="menubtn" href="users.php">Users</a></li>
        <li><a id="logout" href="logout.php">Logout</a></li>
      </ul>
    </div>

    <div class="container">

      <div class="display">

        <form class="searchproducts" method="post">
          <input type="text" name="nume" placeholder="Search...">
          <input type="submit" id="search-button" name="Search" value="Search">
        </form>

        <?php
        if (isset($_POST['Search'])) {
          $_SESSION['searchproduct'] = $_POST["nume"];
          include "productstable.php";
        }elseif (isset($_SESSION['searchproduct'])) {
          include "productstable.php";
        }
         ?>
      </div>
    </div>


    <script>

    function updateStatus(pr_id,user_id,sel)
    {
      var svalue = sel.options[sel.selectedIndex].text;

      var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          alert(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET", "updateStatus.php?prid="+pr_id+"&userid="+user_id+"&selvalue="+svalue, true);
    xmlhttp.send();
    }

    </script>
  </body>
</html>
