<?php


if ( isset($_SESSION['searchforms'])) {

$results_per_page = 5;
$search_term = $_SESSION['searchforms'];

$sql ="SELECT * FROM forms WHERE  Status != 'Waiting for confirmation' AND serialNr LIKE '%$search_term%'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);

if ($count > 0 ) {
  $total_pages = ceil($count / $results_per_page);

  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };

  $start_from = ($page-1) * $results_per_page;
  $sql ="SELECT * FROM forms WHERE Status != 'Waiting for confirmation' AND serialNr LIKE '%$search_term%' LIMIT $start_from,$results_per_page";
  $result = mysqli_query($link, $sql);

  echo "<table id = 'formstable'>

  <tr>
  <th>User Id</th>
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
  </tr>";

  while ($row = mysqli_fetch_assoc($result)){

    echo "<tr>";

    echo "<td>" . $row['user_id'] . "</td>";
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
    echo "</tr>";
  }
  echo "</table>"; mysqli_close($link);

  if ($total_pages >1) {
    echo "<div class='tablepages'>";
    for ($i=1; $i<=$total_pages; $i++)
    {
                echo "<a href='Oldforms.php?page=".$i."'";
                if ($i==$page)  echo " id='curPage'";
                echo ">".$i."</a> ";
    };
    echo "</div>";
  }
}else {

  echo " Sorry no results found";
}


}









 ?>
