
<?php
session_start();

require_once "../connect.php";

$old_password = $new_password = $confirm_new_password = $succesfullform = "";
$old_password_err = $new_password_err = $confirm_new_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{

  // Validate old password
   if(empty(trim($_POST["old_password"]))){
     $old_passowrd_err = "Please enter old password.";
   } else{
     $old_password = $_POST["old_password"];
     $id = $_SESSION["id"];
     $sql = "SELECT password FROM users WHERE id = '$id' ";
     $result = mysqli_query($link, $sql);
     $row = mysqli_fetch_assoc($result);
     $hashed_password = $row['password'];
     if (!password_verify($old_password, $hashed_password)) {
          $old_password_err = "Old password is incorrect";
     }

     }

  // Validate new password
  if(empty(trim($_POST["new_password"]))){
      $new_password_err = "Please enter a password.";
  } elseif(strlen(trim($_POST["new_password"])) < 6){
      $new_password_err = "Password must have atleast 6 characters.";
  } elseif ($_POST["new_password"] == $old_password) {
      $new_password_err = "The new password must be different from the old password.";
  }else{
      $new_password = trim($_POST["new_password"]);
  }

  // Validate confirm new password
  if(empty(trim($_POST["confirm_new_password"]))){
      $confirm_new_password_err = "Please confirm password.";
  } else{
      $confirm_new_password = trim($_POST["confirm_new_password"]);
      if(empty($new_password_err) && ($new_password != $confirm_new_password)){
          $confirm_new_password_err = "Password did not match.";
      }
  }

  if (empty($old_password_err) && empty($new_password_err) && empty($confirm_new_password_err)) {
    $id = $_SESSION["id"];
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = '$hashed_new_password' WHERE id = '$id' ";
    if (mysqli_query($link, $sql)) {
      $succesfullform = "Password was changed!";
    }else {
      echo "Error 404!";
    }


  }

}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Change your password</title>
    <style>
      <?php include 'Style.css'; ?>
    </style>
  </head>
  <body>

    <div class="change-box">

      <h2>Change your password</h2>
      <form  method="post">

        <div class="form-group <?php echo (!empty($old_password_err)) ? 'has-error' : ''; ?>">
            <label>Old Password</label><br>
            <input type="password" name="old_password" class="form-control" value="<?php echo $old_password; ?>"><br>
            <span class="help-block"><?php echo $old_password_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
            <label>New Password</label><br>
            <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>"><br>
            <span class="help-block"><?php echo $new_password_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($confirm_new_password_err)) ? 'has-error' : ''; ?>">
            <label>Confirm New Password</label><br>
            <input type="password" name="confirm_new_password" class="form-control" value="<?php echo $confirm_new_password; ?>"><br>
            <span class="help-block"><?php echo $confirm_new_password_err; ?></span>
        </div>

        <br>
        <input type="submit" id="submit-btn" value="Submit"><br>
        <span id="formsent"><?php echo $succesfullform; ?></span><br>

      </form>

    </div>


  </body>
</html>
