<?php

session_start();

// CHECK if the user is already LOGGED
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

  switch ($_SESSION["user_level"]) {
    case '0':
      header("location: User/home.php");
      break;
    case '1':
      header("location: Admin/home.php");
      break;
    case '2':
      header("location: SuperAdmin/home.php");
      break;
    }

    exit;
}

// CONNECT to the DataBase
require_once "connect.php";

// DEFINE VARIABLES
$username = $password = $confirm_password = $email = $confirm_email = $phone = "";
$username_err = $password_err = $confirm_password_err = $email_err = $confirm_email_err = $phone_err = $response_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){

    //  reCaptcha Parameters
    $secretKey= "6LdJ9aoUAAAAAHvuHMxROjqqMYlWcZeTFAN0NtcR";
    $responseKey= $_POST['g-recaptcha-response'];
    $userIP=$_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";

    $response_err="Please check recaptcha!";

    $response = file_get_contents($url);
    $response = json_decode($response);

    // CHECK reCaptcha server response
    if ($response->success) {
      $response_err="";
    }else {
      $response_err="Check reCaptcha again";
    }

    // Check if the Username field is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter your name.";
    }else{
        $username = trim($_POST["username"]);
    }

    // Check if the Password field is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Check if the Confirm Password field is empty
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        // Check if the ConfirmPassword imput matches the Password imput
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check if the EMAIL field is empty
    if(empty(trim($_POST["email"]))){
      $email_err = "Please enter a email.";
    } else{
      // Search in DataBase for an account that matches the EMAIL imput
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

    // Check if the Confirm Email field is empty
    if(empty(trim($_POST["confirm_email"]))){
        $confirm_email_err = "Please confirm email.";
    } else{
        $confirm_email = trim($_POST["confirm_email"]);
        // Check if the Confirm Email imput matches the Email imput
        if(empty($email_err) && ($email != $confirm_email)){
            $confirm_email_err = "Email did not match.";
        }
    }

    // Check if the Phone Number field is empty
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter a phone number.";
    } else{
        $phone = trim($_POST["phone"]);
    }


    // Check for errors before inserting the input in DataBase
    if(empty($response_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($confirm_email_err) && empty($phone_err)){

        // Inserting the input data to the DataBase
        $sql = "INSERT INTO users (username, password,email,phone,evkey) VALUES (?, ?, ?, ?,?)";
        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password,$param_email,$param_phone,$param_evkey);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_email = $email;
            $param_phone = $phone;
            $param_evkey = md5(time().$username);


            if(mysqli_stmt_execute($stmt)){
              
              // Sending Verification Email
              $to = $email;
              $subject = "Email verification";
              $message = "Verify your account <a href = 'http://localhost/Licenta/verify.php?evkey=$param_evkey'>Here</a>";
              $headers = "From: daniel.ruset@yahoo.com \r\n";
              $headers .= "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

              mail($to,$subject,$message,$headers);

              header("location: login.php");
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <style>
      <?php include 'Style.css'; ?>
    </style>
</head>
<body>
  <header>
    <h1>Warranty24.</h1>
  </header>
    <div class="register">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
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
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">

            <p>Already have an account? <a href="login.php">Login here</a>.</p>
            <div class="g-recaptcha" data-sitekey="6LdJ9aoUAAAAAGkxD7T7CyHt6PZ6tP7lli6H_Uq4"></div><br>
            <span class="help-block"><?php echo $response_err; ?></span>
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        </form>
    </div>
</body>
</html>
