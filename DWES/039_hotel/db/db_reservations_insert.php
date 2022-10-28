<?php

include 'connect_db.php';

$errors = [];

$sql = "SELECT * FROM 039_clients";
$result = mysqli_query($conn, $sql);
$clients = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$sql = "SELECT * FROM 039_rooms";
$result = mysqli_query($conn, $sql);
$rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$id_client = '';
$id_room = '';
$initial_date = '';
$final_date = '';
$total_price = '';
$status_room = '';


if (isset($_POST['submit'])) {

    $id_client = mysqli_real_escape_string($conn, $_POST['id_client']);
    $id_room = mysqli_real_escape_string($conn, $_POST['id_room']);
    $initial_date = mysqli_real_escape_string($conn, $_POST['initial_date']);
    $final_date = mysqli_real_escape_string($conn, $_POST['final_date']);
    $total_price = mysqli_real_escape_string($conn, $_POST['total_price']);
    $status_room = mysqli_real_escape_string($conn, $_POST['status_room']);


    //Validate parameters
    if (!$id_client) {
        $errors[] = 'Client section is empty';
    }
    if (!$id_room) {
        $errors[] = 'Room section is empty';
    }
    if (!$initial_date) {
        $errors[] = 'Initial date section is empty';
    }
    if (!$final_date) {
        $errors[] = 'Final date section is empty';
    }
    if (!$total_price) {
        $errors[] = 'Total price section is empty';
    }
    if (!$status_room) {
        $errors[] = 'Status section is empty';
    }

    //Check array erros is empty
    if (empty($errors)) {
        // write query
        $sql = "INSERT INTO 039_reservations ( ID_client, ID_room, initial_date, final_date, total_price, status_room)";
        $sql .= "VALUES('$id_client','$id_room','$initial_date','$final_date','$total_price' ,'$status_room');";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: /DWES/hotel_039/reservations.php?msg=1');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    // close connection
    mysqli_close($conn);
};
