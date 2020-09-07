<?php


if ( isset($_SESSION['searchproduct'])) {

$results_per_page = 5;
$search_term = $_SESSION['searchproduct'];

$sql ="SELECT * FROM products WHERE serialNr LIKE '%$search_term%'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);

if ($count > 0) {
  $total_pages = ceil($count / $results_per_page);

  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
  $start_from = ($page-1) * $results_per_page;
  $sql ="SELECT * FROM products WHERE serialNr LIKE '%$search_term%' LIMIT $start_from,$results_per_page";
  $result = mysqli_query($link, $sql);

    echo "<table id='formstable'>

    <tr>
    <th>User Id</th>
    <th>Serial Number</th>
    <th>Purchase date</th>
    <th>Warranty length</th>
    <th>Name</th>
    <th>Address</th>
    <th>Status</th>
    </tr>";

  while ($row = mysqli_fetch_assoc($result)){

    $status = $row['Status'];

    switch ($status) {
      case 'Waiting to be received':
      $status = 1;
        break;
      case 'Received':
      $status = 2;
        break;
      case 'Beeing checked':
      $status = 3;
        break;
      case 'Rejected to be repaired':
      $status = 4;
        break;
      case 'Accepted to be repaired':
      $status = 5;
        break;
      case 'Repaired':
      $status = 6;
        break;
      case 'Sent Back':
      $status = 7;
        break;

      default:
        echo "Error 404";
        break;
    }

    $serNr = $row['serialNr'];
    $userid = $row['user_id'];

    echo "<tr>";

    echo "<td>" . $row['user_id'] . "</td>";
    echo "<td>" . $row['serialNr'] . "</td>";
    echo "<td>" . $row['purchaseDate'] . "</td>";
    echo "<td>" . $row['warrantyLength'] . "</td>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['Address'] . "</td>";
    echo "<td>
    <select id='Status' onchange='updateStatus(&#39;$serNr&#39; , &#39;$userid&#39;,this)'>
    <option"; if ($status == 1) {echo " selected ";} echo" value='1'>Waiting to be received</option>
    <option"; if ($status == 2) {echo " selected ";} echo" value='2'>Received</option>
    <option"; if ($status == 3) {echo " selected ";} echo" value='3'>Beeing checked</option>
    <option"; if ($status == 4) {echo " selected ";} echo" value='4'>Rejected to be repaired</option>
    <option"; if ($status == 5) {echo " selected ";} echo" value='5'>Accepted  to be repaired</option>
    <option"; if ($status == 6) {echo " selected ";} echo" value='6'>Repaired</option>
    <option"; if ($status == 7) {echo " selected ";} echo" value='7'>Sent Back</option>
    </select>
    </td>";

    echo "</tr>";

    }
    echo "</table>"; mysqli_close($link);

    if ($total_pages >1) {
      echo "<div class='tablepages'>";
      for ($i=1; $i<=$total_pages; $i++)
      {
                  echo "<a href='products.php?page=".$i."'";
                  if ($i==$page)  echo " id='curPage'";
                  echo ">".$i."</a> ";
      };
      echo "</div>";
    }
}else {
  echo "Sorry,no results found!";
}

}


 ?>
