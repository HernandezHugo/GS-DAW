<?php

include 'connect_db.php';


if (isset($_GET['submit'])) {
    //echo $_GET['ID_persons'];

    $id_persons = mysqli_real_escape_string($conn, $_GET['ID_persons']);

    // write query
    //$sql = "SELECT * FROM 039_persons WHERE ID_persons = '$id_persons'";
    $sql = "SELECT * FROM 039_persons WHERE ID_persons = '$id_persons'";

    // make query and result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $person = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);

    //print_r($person);
};


?>