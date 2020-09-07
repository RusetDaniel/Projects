<?php

if ( (isset($_GET['prid'])) && (isset($_GET['userid'])) && (isset($_GET['selvalue'])) ) {
  require_once "connect.php";

  $product_id = $_GET['prid'];
  $user_id = $_GET['userid'];
  $newstatus_value = $_GET['selvalue'];

  $update = "UPDATE products SET Status = '$newstatus_value' WHERE serialNr = '$product_id' AND user_id = '$user_id'";

  if (mysqli_query($link,$update)) {
    echo "Status has been updated successfully!";
  }
  else {
    echo "Something went wrong!";
  }
}else {
  echo "Parameters are not defined!";
}


 ?>
