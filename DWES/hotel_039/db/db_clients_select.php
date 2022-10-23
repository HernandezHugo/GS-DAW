<?php

$client_selected = [];

if (isset($_POST['submit'])) {

    $id_client = mysqli_real_escape_string($conn, $_POST['ID_client']);

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
