<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

$q = $_GET["q"] ?? '';

$date = date("Y-m-d H-i-s", time());

if ($q) {
  $q_to_decode = json_encode($q);

  $file_name = $date . "_weatherObj.json";

  $sql = "INSERT INTO 039_documents_json (document_name ,document_json, document_date)";
  $sql .= "VALUES ('$file_name',$q_to_decode, '$date')";

  if (mysqli_query($conn, $sql)) {
    //success
    echo "saved in DB";
  } else {
    //error
    echo 'query error: ' . mysqli_error($conn);
  }
}
