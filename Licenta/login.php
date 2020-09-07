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
$email = $password = "";
$email_err = $password_err = $response_err = "";


// ----- FUNCTIONS ---->

// Inserts info about successful or unsuccessful logins
function accounts_traffic($link,$user_id,$ip)
{
  $date = date('Y-m-d H:i:s');
  if ($_SESSION["loggedin"] == true) {
    $login = "successful";
  }else {
    $login = "unsuccessful";
  }
  $sql = "INSERT INTO accounts_traffic (user_id,ip,login,date_time) VALUES('$user_id','$ip','$login','$date')";
  mysqli_query($link, $sql);
}

// Checks if attempt limit has been reached
function attempts_check($link,$user_id)
{
  $date_limit = date('Y-m-d H:i:s', strtotime("-30 minutes"));
  $sql = "SELECT * FROM accounts_traffic WHERE user_id = '$user_id' AND login = 'unsuccessful' AND date_time > '$date_limit'";
  $result = mysqli_query($link, $sql);
  $attempts = mysqli_num_rows($result);

  if ($attempts > 1) {
    $date = date('Y-m-d H:i:s', strtotime("+30 minutes"));
    $sql = " UPDATE users SET blocked = '$date' WHERE id ='$user_id' ";
    mysqli_query($link, $sql);
  }

}

// <----- FUNCTIONS ----


if($_SERVER["REQUEST_METHOD"] == "POST"){

if(isset($_POST['login'])){

  //  reCaptcha Parameters
  $secretKey = "6LdJ9aoUAAAAAHvuHMxROjqqMYlWcZeTFAN0NtcR";
  $responseKey = $_POST['g-recaptcha-response'];
  $userIP = $_SERVER['REMOTE_ADDR'];
  $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";

  $response_err = "Please check reCaptcha!";

  $response = file_get_contents($url);
  $response = json_decode($response);

  // CHECK reCaptcha server response
  if ($response->success) {
    $response_err="";
  }else {
    $response_err="Check reCaptcha again";
  }


    // Check if the EMAIL field is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email!";
    } else{
        $email = trim($_POST["email"]);
    }

    // Check if the PASSWORD field is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password!";
    } else{
        $password = trim($_POST["password"]);
    }

// Check if any error occurred
if(empty($email_err) && empty($password_err) && empty($response_err)){

          // Search in DataBase for an account that matches the EMAIL imput
          $sql = "SELECT id, username, password, verified, email, blocked, user_level FROM users WHERE email = ?";
          if($stmt = mysqli_prepare($link, $sql)){
              mysqli_stmt_bind_param($stmt, "s", $param_email);
              $param_email = $email;
              if(mysqli_stmt_execute($stmt)){
                  mysqli_stmt_store_result($stmt);

                  // Check if an account that matches the EMAIL imput was found
                  if(mysqli_stmt_num_rows($stmt) == 1){
                      mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $verified,$email,$blocked,$user_level);
                      if(mysqli_stmt_fetch($stmt)){

                      // Check if the account is verified
                      if ($verified == 1) {
                        $now = date('Y-m-d H:i:s');
                        // Check if the account is blocked
                        if ($now > $blocked) {
                          // Check if the password imput matches the account password
                          if(password_verify($password, $hashed_password)){

                            // Login is initiated
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["user_level"] = $user_level;

                            switch ($user_level) {
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


                      } else{
                            $password_err = "Incorrect email or password";
                            attempts_check($link,$id);
                          }
                        accounts_traffic($link,$id,$userIP);
                      }else{
                        $password_err = "Account is blocked!";
                      }
                    } else {
                        $password_err= "Account is not verified!";
                  }

                }
              } else{
                  $password_err = "Incorrect email or password";

              }
          }
          mysqli_stmt_close($stmt);
      }
      mysqli_close($link);
    }
  }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
      <?php include 'Style.css'; ?>
    </style>
</head>
<body>
  <header>
    <h1>Warranty24.</h1>
  </header>
    <div class="login">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <input type="email" name="email" class="form-control" placeholder=" Email@yahoo.com" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" class="form-control" placeholder=" Password">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" name="login" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
            <p>Check your product warranty without account <a href="check.php" target="_blank">Here</a>.</p>
            <div class="g-recaptcha" data-sitekey="6LdJ9aoUAAAAAGkxD7T7CyHt6PZ6tP7lli6H_Uq4"></div>
            <span class="help-block"><?php echo $response_err; ?></span>
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        </form>
    </div>

    <div class="brands">
      <label>Brands</label><br>
      <img src="Brands/asus.png">
      <img src="Brands/apple.jpg">
      <img src="Brands/huawei.png">
      <img src="Brands/lenovo.png"><br>
      <img src="Brands/samsung.png">
      <img src="Brands/dell.png">
      <img src="Brands/hp.png">
    </div>
</body>
</html>
