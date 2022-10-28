<?php

include 'connect_db.php';

$reservation_selected = [];
$id_reservation = '';

if (isset($_GET['result'])) {

    $id_reservation = mysqli_real_escape_string($conn, $_GET['result']);

    // write query
    $sql = "SELECT * FROM 039_reservations WHERE ID_reservation = '$id_reservation'";

    // make query and result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $reservation_selected = mysqli_fetch_assoc($result);

    // free result from memory
    mysqli_free_result($result);
};

if (isset($_POST['delete'])) {

    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    // write query
    $sql = "DELETE FROM 039_reservations WHERE ID_reservation = '$id_to_delete'";

    //delete from db and check
    if (mysqli_query($conn, $sql)) {
        //success
        header('Location: /DWES/hotel_039/reservations.php?msg=2');
    } else {
        //error
        echo 'query error: ' . mysqli_error($conn);
    }

    // close connection
    mysqli_close($conn);
};
