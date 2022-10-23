<?php

include 'connect_db.php';

$client_selected = [];
$id_client = '';


if (isset($_POST['delete'])) {

    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    // write query
    $sql = "DELETE FROM 039_clients WHERE ID_client = '$id_to_delete'";

    //delete from db and check
    if (mysqli_query($conn, $sql)) {
        //success
        header('Location: /DWES/hotel_039/clients.php?msg=2');
    } else {
        //error
        echo 'query error: ' . mysqli_error($conn);
    }

    // close connection
    mysqli_close($conn);
};

if (isset($_GET['result'])) {

    $id_client = mysqli_real_escape_string($conn, $_GET['result']);

    // write query
    $sql = "SELECT * FROM 039_clients WHERE ID_client = '$id_client'";

    // make query and result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $client_selected = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);
};
