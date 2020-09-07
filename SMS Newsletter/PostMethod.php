<?php

if(isset($_POST['Submit'])){
  $url = "https://www.smsnewsletter.ro/smsapi/";
  $apikey = "8d154b2341cde936126495018c432330";
  $telefon = $_POST['telefon'];
  $mesaj = array(array('message'=> $_POST['mesaj'],'phone' => $telefon,'alias' => "",'start'=> 0,'stop' => 0));
  $mesaj = json_encode($mesaj);

  $data = array(
    'apikey' => $apikey,
    'messages' => $mesaj
  );

  $ch = curl_init($url);

  curl_setopt($ch,CURLOPT_POST, count($data));
  curl_setopt($ch,CURLOPT_POSTFIELDS, $data);

  $result = curl_exec($ch);
  curl_close($ch);

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SMS Newsletter - Json</title>
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
