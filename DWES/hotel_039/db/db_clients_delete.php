<?php

include 'connect_db.php';


if (isset($_GET['submit'])) {
    //echo $_GET['ID_client'];

    $id_client = mysqli_real_escape_string($conn, $_GET['ID_client']);

    // write query
    $sql = "DELETE FROM 039_clients WHERE ID_client = '$id_client'";

    // make query and result
    $result = mysqli_query($conn, $sql);

    // close connection
    mysqli_close($conn);

};


?>