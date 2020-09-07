
<?php
session_start();

require_once "connect.php";

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

$user_id = $_SESSION["id"];

 ?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Products</title>
<style>
  <?php include 'Style.css'; ?>
</style>
</head>
<body>
    <div class="sidebar">
      <h1>Menu</h1>
      <ul>
        <li><a class="menubtn" href="home.php">Home</a></li>
        <li><a class="menubtn" href="account.php">Account</a></li>
        <li><a class="menubtn" href="Sentform.php">Sent Form</a></li>
        <li><a class="menubtn" href="Myforms.php">My Forms</a></li>
        <li><a id="current" href="Myproducts.php">My Products</a></li>
        <li><a id="logout" href="logout.php">Logout</a></li>
      </ul>
    </div>

    <div class="container">

      <div class="products-box">

        <h3 id="producth3">My products</h3>

        <?php


        $sql ="SELECT * FROM products WHERE user_id LIKE '$user_id'";
        $result = mysqli_query($link, $sql);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
          echo "<table class = 'productstable'>

          <tr>
          <th>Product Name</th>
          <th>Product Serial Number</th>
          <th>Purchase Date</th>
          <th>Warranty Length</th>
          <th>Status</th>
          </tr>";

          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";

            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['serialNr'] . "</td>";
            echo "<td>" . $row['purchaseDate'] . "</td>";
            echo "<td>" . $row['warrantyLength'] . "</td>";
            echo "<td>" . $row['Status'] . "</td>";
              echo "</tr>";

          }

          echo "</table>";
        }else {
          echo "No products found.";
        }


         ?>
      </div>
    </div>
</body>
