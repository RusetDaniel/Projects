<?php

if(isset($_GET['invoiceid']) && !empty($_GET['invoiceid']) && isset($_GET['answer']) && !empty($_GET['answer']))
{
    session_start();
    require_once "connect.php";

    $invoice_id = $_GET['invoiceid'];
    $answer = $_GET['answer'];
    $serialnr = $_GET['serialNr'];
    $user_id = $_GET['userid'];
    $address = $_GET['address'];

    $update = "UPDATE forms SET Status = '$answer' WHERE invoice_id = '$invoice_id'";

    if (mysqli_query($link, $update))
    {
      $sql = "SELECT * from products WHERE serialNr = '$serialnr' AND user_id = '$user_id' LIMIT 1";
      $result = mysqli_query($link,$sql);
      if ($answer == "Confirmed") {
        if (mysqli_num_rows($result) >= 1) {
          $sql = "UPDATE products SET Status = 'Waiting to be received',Address = '$address' WHERE serialNr = '$serialnr' AND user_id = '$user_id'";
          mysqli_query($link,$sql);

        }else {
          //ADD product if does not exist
          $sql = "SELECT * FROM forms WHERE invoice_id = '$invoice_id'";

          if ($result = mysqli_query($link,$sql)) {
            if ($row = mysqli_fetch_assoc($result)) {
              $purchaseDate = $row['purchaseDate'];
              $warranty = $row['warrantyLength'];
              $name = $row['Name'];
              $sql = "INSERT INTO products (serialNr,purchaseDate,warrantyLength,Name,user_id,Address,Status) VALUES ('$serialnr','$purchaseDate','$warranty','$name','$user_id','$address','Waiting to be received')";
              mysqli_query($link,$sql);
            }
          }
        }
      }


      echo "Record updated successfully";
    }
    else
    {
        echo "Error updating record: " . mysqli_error($link);
    }
    die;
}
 ?>
