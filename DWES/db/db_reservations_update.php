<?php

include ($_SERVER['DOCUMENT_ROOT'].'/dwes/db/connect_db.php');

$errors = [];

//get id from url
$id = $_GET['result'];
$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM 039_reservations WHERE ID_reservation = '$id'";
$result = mysqli_query($conn, $sql);
$reservation_selected = mysqli_fetch_assoc($result);
mysqli_free_result($result);

//get clients to dropdown
$sql = "SELECT * FROM 039_clients";
$result = mysqli_query($conn, $sql);
$clients = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

//get rooms to dropdown
$sql = "SELECT * FROM 039_rooms";
$result = mysqli_query($conn, $sql);
$rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

//get every data from ID_reservation and put it as default
$id_client = $reservation_selected['ID_client'];
$id_room = $reservation_selected['ID_room'];
$initial_date = $reservation_selected['initial_date'];
$final_date = $reservation_selected['final_date'];
$total_price = $reservation_selected['total_price'];
$status_room = $reservation_selected['status_room'];

//get name from clients to dropdown value selected
$sql = "SELECT firstname FROM 039_clients WHERE ID_client = '$id_client'";
$result = mysqli_query($conn, $sql);
$client_selected = mysqli_fetch_assoc($result);
mysqli_free_result($result);

//get name from rooms to dropdown value selected
$sql = "SELECT name_room FROM 039_rooms WHERE ID_room = '$id_room'";
$result = mysqli_query($conn, $sql);
$room_selected = mysqli_fetch_assoc($result);
mysqli_free_result($result);


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
        $sql = "UPDATE 039_reservations SET ID_client = '$id_client', ID_room = '$id_room' , initial_date = '$initial_date',";
        $sql .= " final_date = '$final_date', total_price = '$total_price', status_room = '$status_room' WHERE ID_reservation = '$id';";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: /dwes/reservations.php?msg=3');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    // close connection
    mysqli_close($conn);
};
