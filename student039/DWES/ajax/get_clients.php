<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

$q = $_GET['q'];


if ($q !== "") {

    $q = strtolower($q);

    // write query
    $sql = "SELECT * FROM 039_clients WHERE firstname LIKE '%$q%'";
    // make query and result
    $result = mysqli_query($conn, $sql);
    // fetch the resulting rows as an array
    $clients = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // free result from memory
    mysqli_free_result($result);

    echo json_encode($clients);
}
