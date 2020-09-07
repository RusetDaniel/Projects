<?php

if(isset($_GET['user_id']) && !empty($_GET['user_id']))
{
  session_start();
  require_once "connect.php";

  $user_id = $_GET["user_id"];
  $sql = "DELETE FROM users WHERE Id = '$user_id'";
  if (mysqli_query($link, $sql)) {
    echo "The account has been successfully deleted!";
  }else
    {
      echo "Error account not deleted : " . mysqli_error($link);
    }
    die;
}else
  {
    echo "Error account not deleted : " . mysqli_error($link);
  }



 ?>
