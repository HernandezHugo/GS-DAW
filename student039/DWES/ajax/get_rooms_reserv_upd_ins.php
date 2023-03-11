<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

$q = $_GET['q'];


if ($q !== "") {

    $q = strtolower($q);

    // write query
    $sql = "SELECT * FROM 039_rooms WHERE ID_category = $q";
    // make query and result
    $result = mysqli_query($conn, $sql);
    // fetch the resulting rows as an array
    $rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // free result from memory
    mysqli_free_result($result);

    echo json_encode($rooms);
}
