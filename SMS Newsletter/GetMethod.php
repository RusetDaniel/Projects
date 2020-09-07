<?php

$apikey = "8d154b2341cde936126495018c432330";


if (isset($_POST['Submit'])) {
  $telefon = $_POST['telefon'];
  $mesaj = $_POST['mesaj'];
  $url = "https://www.smsnewsletter.ro/smsapirest/$apikey/$telefon/$mesaj/";
  header("Location: $url");
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SMS Newsletter Direct  url</title>
  </head>
  <body>

    <form method="post">
      <p>Telefon:</p>
      <input type="text" name="telefon" value="" style="width: 250px;">
      <p>Mesaj:</p>
      <textarea name="mesaj" rows="15" cols="50"></textarea>
      <br>
      <input type="submit" name="Submit" value="Trimite mesajul!" style="background-color: black; color:white; border: 1px solid black; border-radius: 2px;">
    </form>

  </body>
</html>
