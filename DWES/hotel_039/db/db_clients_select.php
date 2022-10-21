<?php

include 'connect_db.php';


if (isset($_GET['submit'])) {
    //echo $_GET['ID_client'];

    $id_client = mysqli_real_escape_string($conn, $_GET['ID_client']);

    // write query
    $sql = "SELECT * FROM 039_clients WHERE ID_client = '$id_client'";

    // make query and result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $client = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);

    //print_r($client);
};
