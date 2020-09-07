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

// CONNECT to the DataBase
require_once "connect.php";


 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forms</title>
    <style>
    <?php include 'Style.css' ?>
</style>
  </head>
  <body>


    <div class="sidebar">
      <h1>Menu</h1>
      <ul>
        <li><a class="menubtn" href="home.php">Home</a></li>
        <li><a id="current" href="Newforms.php">New Forms</a></li>
        <li><a class="menubtn" href="Oldforms.php">Old Forms</a></li>
        <li><a class="menubtn" href="products.php">Products</a></li>
        <li><a class="menubtn" href="users.php">Users</a></li>
        <li><a id="logout" href="logout.php">Logout</a></li>
      </ul>
    </div>

    <div class="container">
      <div class="display">
        <?php
        include 'formstable.php'
         ?>
      </div>
    </div>

    <script>

    function Formanswer(invoice_id,answer,user_id,serial_nr,address,btn)
    {
      var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          var i = btn.parentNode.parentNode.rowIndex;
          document.getElementById("formstable").deleteRow(i);
          alert(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET", "updateform.php?invoiceid="+invoice_id+"&answer="+answer+"&userid="+user_id+"&serialNr="+serial_nr+"&address="+address, true);
    xmlhttp.send();
    }
    </script>

  </body>
</html>
