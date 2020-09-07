<?php

session_start();

// CHECK if the user is already LOGGED
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}

// CONNECT to the DataBase
require_once "connect.php";

// DEFINE VARIABLES
$serialNr =  $serialNr_err = $response_err = $message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

  if(isset($_POST['check'])) {
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
    }else{
      $response_err="Check reCaptcha again";
    }

    // Check if the SerialNumber field is empty
    if(empty(trim($_POST["serialNr"]))){
        $serialNr_err = "Please enter a Serial Number.";
    }else{
      $serialNr = trim($_POST["serialNr"]);
    }

    // Check if any error occurred
    if(empty($serialNr_err) && empty($response_err)){

        // Search in DataBase for a product that matches the SerialNumber imput
        $sql = "SELECT serialNr, purchaseDate, warrantyLength FROM products WHERE serialNr = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_serialNr);
            $param_serialNr = $serialNr;
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                // Check if a product that matches the SerialNumber imput was found
                if(mysqli_stmt_num_rows($stmt) == 1){
                  mysqli_stmt_bind_result($stmt, $serialNr,$purchaseDate,$warrantyLength);
                  if(mysqli_stmt_fetch($stmt)){
                    $exp_date = date('Y-m-d', strtotime($purchaseDate. " + {$warrantyLength} year"));
                    $today_date = date('Y/m/d');
                    $td = strtotime($today_date);

                    // Check if the warranty of the found product is expired or not
                    if ($today_date > $exp_date) {
                      $message = "Warranty EXPIRED at {$exp_date}";
                    }
                    else {
                      $message ="Warranty AVALIABLE  until {$exp_date}";
                    }
                  }
                }
                else {
                  {
                    $serialNr_err= "Product not found!";
                  }
                }
              }
            }
          }
        }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check</title>
    <style>
      <?php include 'Style.css'; ?>
    </style>
</head>
<body>
  <header>
    <h1>Warranty24.</h1>
  </header>

    <div class="check">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($serialNr_err)) ? 'has-error' : ''; ?>">
                <h2>Check Warranty</h2>
                <span class="message"><?php echo $message; ?></span><br>
                <input type="text" name="serialNr" class="form-control" placeholder=" Serial number"value="<?php echo $serialNr; ?>"><br>
                <span class="help-block"><?php echo $serialNr_err; ?></span>
            </div><br>

            <div class="form-group">
                <input type="submit" name="check" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset"><br>
            </div>
            <div class="g-recaptcha" data-sitekey="6LdJ9aoUAAAAAGkxD7T7CyHt6PZ6tP7lli6H_Uq4"></div>
            <span class="help-block"><?php echo $response_err; ?></span>
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </form>
</div>

</body>
</html>
