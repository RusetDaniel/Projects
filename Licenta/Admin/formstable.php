<?php
$results_per_page = 4;

$sql ="SELECT * FROM forms WHERE Status LIKE 'Waiting for confirmation'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);

if ($count > 0) {

  $total_pages = ceil($count / $results_per_page);

  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
  $start_from = ($page-1) * $results_per_page;
  $sql ="SELECT * FROM forms WHERE Status LIKE 'Waiting for confirmation' LIMIT $start_from,$results_per_page";
  $result = mysqli_query($link, $sql);

  echo "<table id = 'formstable'>

  <tr>
  <th>User id</th>
  <th>Name</th>
  <th>Country</th>
  <th>City</th>
  <th>Address</th>
  <th>Place of purchase</th>
  <th>Serial number</th>
  <th>Purchase date</th>
  <th>Warranty length</th>
  <th>Defect Description</th>
  <th>Invoice image</th>
  <th>Warranty image</th>
  <th>Confirm/Decline</th>
  </tr>";

  while ($row = mysqli_fetch_assoc($result)){
    $form_id = $row['invoice_id'];
    $user_id = $row['user_id'];
    $serialnr = $row['serialNr'];
    $address = $row['Address'];
    echo "<tr>";

    echo "<td>$user_id</td>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['country'] . "</td>";
    echo "<td>" . $row['city'] . "</td>";
    echo "<td>" . $row['Address'] . "</td>";
    echo "<td>" . $row['place_of_purchase'] . "</td>";
    echo "<td>" . $row['serialNr'] . "</td>";
    echo "<td>" . $row['purchaseDate'] . "</td>";
    echo "<td>" . $row['warrantyLength'] . "</td>";
    echo "<td>" . $row['defectDescription'] . "</td>";
    echo "<td><a id='invoice-path' href ='http://127.0.0.1/Licenta/invoiceImg/".$row['invoice_path']."'>Check invoice scan</a></td>";
    echo "<td><a id='invoice-path' href ='http://127.0.0.1/Licenta/warrantyImg/".$row['warranty_path']."'>Check warranty scan</a></td>";
  echo "<td><button type='button' onclick='Formanswer( &#39;$form_id&#39; , &#39;Confirmed&#39; , &#39;$user_id&#39; , &#39;$serialnr&#39;,  &#39;$address&#39; ,this)'>Confirm</button><button type='button' onclick='Formanswer(&#39;$form_id&#39; , &#39;Declined&#39; , &#39;$user_id&#39; , &#39;$serialnr&#39;, &#39;$address&#39; ,this)'>Decline</button></td>";
    //echo "<img src='".$row['invoice_path']."' />";



    echo "</tr>";

    }
  echo "</table>"; mysqli_close($link);

  if ($total_pages >1) {
    echo "<div class='tablepages'>";
    for ($i=1; $i<=$total_pages; $i++)
    {
                echo "<a href='Newforms.php?page=".$i."'";
                if ($i==$page)  echo " id='curPage'";
                echo ">".$i."</a> ";
    };
    echo "</div>";

  }
}else {
  echo "No new forms received";
}



 ?>
