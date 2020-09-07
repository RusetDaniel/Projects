<?php
// Initialize the session
session_start();

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
// CONNECT to the DataBase
require_once "connect.php";

// DEFINE VARIABLES
$succesfullform = "";
$name = $country = $city = $address = $place_of_purchase = $serialNr = $confirm_serialNr = $purchaseDate = $warrantyLength = $defectDescription = $invoice = $warrantyscan = "";
$name_err = $country_err = $city_err = $address_err = $place_of_purchase_err = $serialNr_err = $confirm_serialNr_err = $purchaseDate_err = $warrantyLength_err = $defectDescription_err = $invoice_err = $warranty_err = "";


 if (isset($_POST['submit'])) {


      $invoice_path = "../invoiceImg/";
      $warranty_path = "../warrantyImg/";

   // Validate Product Name
   if(empty(trim($_POST["name"]))){
       $name_err = "Please please fill out this field.";
   }else{
       $name = trim($_POST["name"]);
   }

   // Validate Country
   if(empty(trim($_POST["country"]))){
       $country_err = "Please please fill out this field.";
   }else{
       $country = trim($_POST["country"]);
   }

   // Validate City
   if(empty(trim($_POST["city"]))){
       $city_err = "Please please fill out this field.";
   }else{
       $city = trim($_POST["city"]);
   }

   // Validate address
   if(empty(trim($_POST["address"]))){
       $address_err = "Please please fill out this field.";
   }else{
       $address = trim($_POST["address"]);
   }

   // Validate Place of purchase
   if(empty(trim($_POST["purchasePlace"]))){
       $place_of_purchase_err = "Please please fill out this field.";
   }else{
       $place_of_purchase = trim($_POST["purchasePlace"]);
   }

   // Validate Serial number
   if(empty(trim($_POST["serialNr"]))){
       $serialNr_err = "Please please fill out this field.";
   }else{
       $serialNr = trim($_POST["serialNr"]);
   }

   // Validate Confirm Serial Number
   if(empty(trim($_POST["confirm_serialNr"]))){
       $confirm_serialNr_err = "Please please fill out this field.";
   }else{
     $confirm_serialNr = trim($_POST["confirm_serialNr"]);
     if(empty($serialNr_err) && ($serialNr != $confirm_serialNr)){
         $confirm_serialNr_err = "Serial number did not match.";
     }
   }

   // Validate Purchase Date
   if(empty(trim($_POST["purchaseDate"]))){
       $purchaseDate_err = "Please please fill out this field.";
   }else{
       $purchaseDate = trim($_POST["purchaseDate"]);
   }

   // Validate Warranty Length
   if(empty(trim($_POST["warrantyLength"]))){
       $warrantyLength_err = "Please please fill out this field.";
   }else{
       $warrantyLength = trim($_POST["warrantyLength"]);
   }

   // Validate warranty validity
   if (empty($purchaseDate_err) && empty($warrantyLength_err)) {
     $exp_date = date('Y-m-d', strtotime($purchaseDate. " + {$warrantyLength} year"));
     $today_date = date('Y/m/d');
     $td = strtotime($today_date);
     if ($today_date > $exp_date) {
       $warrantyLength_err = "Warranty EXPIRED at {$exp_date}";
     }
   }


   // Validate Defect Description
   if(empty(trim($_POST["defectDescription"]))){
       $defectDescription_err = "Please please fill out this field.";
   }else{
       $defectDescription = trim($_POST["defectDescription"]);
   }

   // Validate Invoice scan
   if(empty($_FILES['inv-image']['name'])){
       $invoice_err = "Please insert file.";
   }else{
       $invoice = $_FILES['inv-image']['tmp_name'];
       if(getimagesize($_FILES['inv-image']['tmp_name']) === FALSE) {
         $invoice_err = "Please insert an image file.";
       }

   }

   // Validate warranty scan
   if(empty($_FILES['warr-image']['name'])){
       $warranty_err = "Please insert file.";
   }else{
       $warrantyscan = $_FILES['warr-image']['tmp_name'];
       if(getimagesize($_FILES['warr-image']['tmp_name']) === FALSE) {
         $warranty_err = "Please insert an image file.";
       }
   }




   if (empty($name_err) && empty($country_err) && empty($city_err) && empty($address_err) && empty($place_of_purchase_err) && empty($serialNr_err) && empty($confir_serialNr_err) && empty($purchaseDate_err) && empty($warrantyLength_err)&& empty($defectDescription_err) && empty($invoice_err) && empty($warranty_err)) {

     $uniquesavename=time().uniqid(rand());

     list($width, $height, $typeCode) = getimagesize($invoice);
     switch ($typeCode) {
     case 2:
         $destFile1 = $invoice_path . $uniquesavename . '.jpg';
         break;
     case 3:
         $destFile1 = $invoice_path . $uniquesavename . '.png';
         break;
       }

      list($width, $height, $typeCode) = getimagesize($warrantyscan);
     switch ($typeCode) {
     case 2:
         $destFile2 = $warranty_path . $uniquesavename . '.jpg';
           break;
       case 3:
           $destFile2 = $warranty_path . $uniquesavename . '.png';
           break;
         }

    $sql = "INSERT INTO forms(user_id,country,city,address,place_of_purchase,serialNr,purchaseDate,warrantyLength,defectDescription,invoice_path,warranty_path,name) VALUES(?,?,?,?,?,?,?,?,?,'$destFile1','$destFile2',?)";

    if($stmt = mysqli_prepare($link, $sql)){

      mysqli_stmt_bind_param($stmt, "isssssssss", $user_id, $param_country,$param_city,$param_address,$param_place_of_purchase,$param_serialNr,$param_purchaseDate,$param_warrantyLength,$param_defectDescription,$param_name);

      $user_id = $_SESSION["id"];
      $param_country = $country;
      $param_city = $city;
      $param_address = $address;
      $param_place_of_purchase = $place_of_purchase;
      $param_serialNr = $serialNr;
      $param_purchaseDate = $purchaseDate;
      $param_warrantyLength = $warrantyLength;
      $param_defectDescription = $defectDescription;
      $param_name = $name;

      if (mysqli_stmt_execute($stmt)) {
        if (move_uploaded_file($invoice, $destFile1)) {
          move_uploaded_file($warrantyscan, $destFile2);
          $country = $city = $address = $place_of_purchase = $serialNr = $confirm_serialNr = $purchaseDate = $warrantyLength = $defectDescription = $invoice = $warrantyscan =  $name = "";
          $succesfullform = "Form was successfully sent!";
        }else {
          echo "Something went wrong!";
        }
      }else {
        $invoice_err = "Something went wrong!";
      }
    }
   }
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Sent Your Form</title>
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
      <li><a id="current" href="Sentform.php">Sent Form</a></li>
      <li><a class="menubtn" href="Myforms.php">My Forms</a></li>
      <li><a class="menubtn" href="Myproducts.php">My Products</a></li>
      <li><a id="logout" href="logout.php">Logout</a></li>
    </ul>
  </div>


  <div class="containerregister">
    <form  class="Warrantyform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

      <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
        <label>Product Name</label><br>
        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>"><br>
        <span class="help-block"><?php echo $name_err; ?></span>
      </div>

      <div class="form-group <?php echo (!empty($country_err)) ? 'has-error' : ''; ?>">
        <label>Country</label><br>
        <input type="text" name="country" class="form-control" value="<?php echo $country; ?>"><br>
        <span class="help-block"><?php echo $country_err; ?></span>
      </div>

      <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
        <label>City</label><br>
        <input type="text" name="city" class="form-control" value="<?php echo $city; ?>"><br>
        <span class="help-block"><?php echo $city_err; ?></span>
      </div>

      <div class="form-group">
        <label>Address</label>
        <input type="text" name="address" class="form-control" value="<?php echo $address; ?>"><br>
        <span class="help-block"><?php echo $address_err; ?></span>
      </div>

      <div class="form-group <?php echo (!empty($place_of_purchase_err)) ? 'has-error' : ''; ?>">
        <label>Place of purchase</label><br>
        <input type="text" name="purchasePlace" class="form-control" value="<?php echo $place_of_purchase; ?>"><br>
        <span class="help-block"><?php echo $place_of_purchase_err; ?></span>
      </div>

      <div class="form-group <?php echo (!empty($serialNr_err)) ? 'has-error' : ''; ?>">
        <label>Serial number</label><br>
        <input type="text" name="serialNr" class="form-control" value="<?php echo $serialNr; ?>"><br>
        <span class="help-block"><?php echo $serialNr_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($confirm_serialNr_err)) ? 'has-error' : ''; ?>">
        <label>Confirm serial number</label><br>
        <input type="text" name="confirm_serialNr" class="form-control" value="<?php echo $confirm_serialNr; ?>"><br>
        <span class="help-block"><?php echo $confirm_serialNr_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($purchaseDate_err)) ? 'has-error' : ''; ?>">
        <label>Purchase date</label><br>
        <input type="date" name="purchaseDate" id="purchaseDate" value="<?php echo $purchaseDate; ?>"><br>
        <span class="help-block"><?php echo $purchaseDate_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($warrantyLength_err)) ? 'has-error' : ''; ?>">
        <label>Warranty length</label><br>
        <input type="text" name="warrantyLength" class="form-control" value="<?php echo $warrantyLength; ?>"><br>
        <span class="help-block"><?php echo $warrantyLength_err; ?></span>
      </div>
      <div class="form-group" <?php echo (!empty($defectDescription_err)) ? 'has-error' : '';  ?>>
        <label>Defect description</label>
        <textarea name="defectDescription" rows="4" cols="40" value="<?php echo $defectDescription; ?>"></textarea><br>
        <span class="help-block"><?php echo $defectDescription_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($invoice_err)) ? 'has-error' : ''; ?>">
        <label>Invoice scan</label><br>
        <input type="file" name="inv-image" id="invoice"><br>
        <span class="help-block"><?php echo $invoice_err; ?></span><br>
      </div>
      <div class="form-group <?php echo (!empty($warranty_err)) ? 'has-error' : ''; ?>">
        <label>Warranty scan</label><br>
        <input type="file" name="warr-image" id="invoice"><br>
        <span class="help-block"><?php echo $warranty_err; ?></span><br>
      </div>
      <input type="submit" name="submit" id="submit-btn" value="Submit"><br>
      <span id="formsent"><?php echo $succesfullform; ?></span><br>
    </form>

  </div>


</body>
</html>
