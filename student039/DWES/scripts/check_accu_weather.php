<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

//30 minutes before
$date = date("Y-m-d H-i-s", time() - 1800);

$sql = "SELECT document_json FROM 039_documents_json WHERE document_date > '$date'";

$result = mysqli_query($conn, $sql);

if ($result->num_rows) {
  $document_selected = mysqli_fetch_assoc($result);
  //send it already encoded
  echo $document_selected['document_json'];
} else {
  //we hadn't call accu weather since more than 30 minutes
  echo 'call AccuWeather';
}
// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);
