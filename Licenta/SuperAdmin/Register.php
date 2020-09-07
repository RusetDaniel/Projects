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
  header("location: ../login.php");
  exit;
}


require_once "connect.php";


$username = $password = $confirm_password = $email = $confirm_email = $phone = "";
$username_err = $password_err = $confirm_password_err = $email_err = $confirm_email_err = $phone_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){


    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter your name.";
    }else{
        $username = trim($_POST["username"]);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
      $email_err = "Please enter a email.";
    } else{
      $sql = "SELECT id FROM users WHERE email = ?";

      if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "s", $param_email);

        $param_email = trim($_POST["email"]);

        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);

          if(mysqli_stmt_num_rows($stmt) >= 1){
           $email_err = "This email is used.";
         } else{
            $email = trim($_POST["email"]);
          }
          } else{
            echo "Oops! Something went wrong. Please try again later.";
          }
        }

        mysqli_stmt_close($stmt);
      }

    // Validate confirm email
    if(empty(trim($_POST["confirm_email"]))){
        $confirm_email_err = "Please confirm email.";
    } else{
        $confirm_email = trim($_POST["confirm_email"]);
        if(empty($email_err) && ($email != $confirm_email)){
            $confirm_email_err = "Email did not match.";
        }
    }

    // Validate phone
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter a phone number.";
    } else{
        $phone = trim($_POST["phone"]);
    }


    // Check for errors before inserting
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($confirm_email_err) && empty($phone_err)){

        $sql = "INSERT INTO users (username, password,email,phone,evkey,user_level) VALUES (?, ?, ?, ?,?,1)";

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password,$param_email,$param_phone,$param_evkey);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_email = $email;
            $param_phone = $phone;
            $param_evkey = md5(time().$username);


            if(mysqli_stmt_execute($stmt)){
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}



 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Super-Admin</title>
    <style>
      <?php include 'Style.css'; ?>
    </style>
  </head>
  <body>

    <div class="sidebar">
      <h1>Menu</h1>
      <ul>
        <li><a class="menubtn" href="home.php">Home</a></li>
        <li><a class="menubtn" href="users.php">Users</a></li>
        <li><a id="current" href="Register.php">Register New Admin</a></li>
        <li><a id="logout" href="logout.php">Logout</a></li>
      </ul>
    </div>

    <div class="container">

    <div class="register-box">
        <h2>Add new admin account here..</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Full Name</label><br>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>"><br>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label><br>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>"><br>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label><br>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>"><br>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label><br>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>"><br>
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($confirm_email_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Email</label><br>
                <input type="text" name="confirm_email" class="form-control" value="<?php echo $confirm_email; ?>"><br>
                <span class="help-block"><?php echo $confirm_email_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                <label>Phone Number</label><br>
                <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>"><br>
                <span class="help-block"><?php echo $phone_err; ?></span>
            </div>

            <br>
                <input type="submit" id="submit-btn" value="Submit">
            </form>
          </div>
        </div>
  </body>
</html>
