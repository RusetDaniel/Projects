<?php


if ( isset($_SESSION['searchusers'])) {

$results_per_page = 5;
$search_term = $_SESSION['searchusers'];

$sql ="SELECT * FROM users WHERE user_level = 0 AND verified = 1 AND Id LIKE '%$search_term%'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
if ($count > 0 ) {
  $total_pages = ceil($count / $results_per_page);
  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
  $start_from = ($page-1) * $results_per_page;
  $sql ="SELECT * FROM users WHERE user_level = 0 AND verified = 1 AND Id LIKE '%$search_term%' LIMIT $start_from,$results_per_page";
  $result = mysqli_query($link, $sql);

  echo "<table id = 'usersstable'>

  <tr>
  <th>ID</th>
  <th>Email</th>
  <th>Name</th>
  <th>Phone</th>
  <th>Creation Date</th>
  </tr>";

  while ($row = mysqli_fetch_assoc($result)){

    echo "<tr>";

    echo "<td>" . $row['Id'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['phone'] . "</td>";
    echo "<td>" . $row['creation_date'] . "</td>";
    echo "</tr>";
  }
  echo "</table>"; mysqli_close($link);

  if ($total_pages >1) {
    echo "<div class='tablepages'>";
    for ($i=1; $i<=$total_pages; $i++)
    {
                echo "<a href='users.php?page=".$i."'";
                if ($i==$page)  echo " id='curPage'";
                echo ">".$i."</a> ";
    }
    echo "</div>";
  }
}else {

  echo " Sorry no results found";
}

}









 ?>
