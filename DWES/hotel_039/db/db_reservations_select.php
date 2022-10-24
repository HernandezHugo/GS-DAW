<?php

$reservation_selected = [];

if (isset($_POST['submit'])) {

    $id_reservation = mysqli_real_escape_string($conn, $_POST['ID_reservation']);

    // write query
    $sql = "SELECT * FROM 039_reservations WHERE ID_reservation = '$id_reservation'";

    // make query and result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $reservation_selected = mysqli_fetch_assoc($result);

    // free result from memory
    mysqli_free_result($result);
    
    // close connection
    mysqli_close($conn);
};
