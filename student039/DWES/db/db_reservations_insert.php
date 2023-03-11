<?php

include ($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/db/connect_db.php');

$errors = [];

$sql = "SELECT * FROM 039_clients";
$result = mysqli_query($conn, $sql);
$clients = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$sql = "SELECT * FROM 039_categories";
$result = mysqli_query($conn, $sql);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$id_client = '';
$id_room = '';
$id_category = '';
$initial_date = '';
$final_date = '';
$number_guests = '';
$total_price = '';
$id_status = '';


if (isset($_POST['submit'])) {

    $id_client = mysqli_real_escape_string($conn, $_POST['id_client']);
    $id_room = mysqli_real_escape_string($conn, $_POST['id_room']);
    $id_category = mysqli_real_escape_string($conn, $_POST['id_category']);
    $initial_date = mysqli_real_escape_string($conn, $_POST['initial_date']);
    $final_date = mysqli_real_escape_string($conn, $_POST['final_date']);
    $number_guests = mysqli_real_escape_string($conn, $_POST['number_guests']);
    $total_price = mysqli_real_escape_string($conn, $_POST['total_price']);
    $id_status = mysqli_real_escape_string($conn, $_POST['ID_status']);


    //Validate parameters
    if (!$id_client) {
        $errors[] = 'Client section is empty';
    }
    if (!$id_room) {
        $errors[] = 'Room section is empty';
    }
    if (!$id_category) {
        $errors[] = 'Category section is empty';
    }
    if (!$initial_date) {
        $errors[] = 'Initial date section is empty';
    }
    if (!$final_date) {
        $errors[] = 'Final date section is empty';
    }
    if (!$number_guests) {
        $errors[] = 'Guests section is empty';
    }
    if (!$total_price) {
        $errors[] = 'Total price section is empty';
    }
    if (!$id_status) {
        $errors[] = 'Status section is empty';
    }

    //Check array erros is empty
    if (empty($errors)) {
        // write query
        $sql = "INSERT INTO 039_reservations ( ID_client, ID_room, ID_category, initial_date, final_date, number_guests, total_price, ID_status)";
        $sql .= "VALUES('$id_client','$id_room', '$id_category','$initial_date','$final_date','$number_guests','$total_price' ,'$id_status');";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: /student039/dwes/reservations.php?msg=1');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    // close connection
    mysqli_close($conn);
};
