<?php

// CONNECT to the DataBase
require_once "connect.php";

if (isset($_GET['evkey'])) {

  // Getting the verification key from url
  $evkey = $_GET['evkey'];
  //Search for an account that is not verified and matches the verification key
  $sql = "SELECT verified,evkey FROM users WHERE verified = 0 AND evkey = ?";

if ($stmt = mysqli_prepare($link,$sql)) {

mysqli_stmt_bind_param($stmt, "s", $evkey);
  if (mysqli_stmt_execute($stmt)) {
      mysqli_stmt_store_result($stmt);
      if (mysqli_stmt_num_rows($stmt) == 1) {

      // Verify the account
      $sql = "UPDATE users SET verified = 1 WHERE evkey = '$evkey'";
        if (mysqli_query($link, $sql)) {
            echo "Your account has been activated.You can <a href='http://127.0.0.1/Licenta/login.php'>login</a> now";
        }
        else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }

      }
      else {
        echo "Invalid account or already verified!";
      }
  }else {
    echo "Something went wrong!Please try again.";
  }
}else {
  echo "Something went wrong!";
}
}else {
  die("Something went wrong!");
}

mysqli_close($link);


 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Email verification</title>
  </head>
  <body>



  </body>
</html>
