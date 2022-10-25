<?php

include 'connect_db.php';

$errors = [];

//get id from url
$id = $_GET['result'];
$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

// write query
$sql = "SELECT * FROM 039_reservations WHERE ID_reservation = '$id'";
// make query and result
$result = mysqli_query($conn, $sql);
// fetch the resulting rows as an array
$reservation_selected = mysqli_fetch_assoc($result);
// free result from memory
mysqli_free_result($result);

//get reservation_data
$dni = $reservation_selected['dni'];
$firstname = $reservation_selected['firstname'];
$surname = $reservation_selected['surname'];
$email = $reservation_selected['email'];
$phone_number = $reservation_selected['phone_number'];


if (isset($_POST['submit'])) {

    $dni = mysqli_real_escape_string($conn, $_POST['dni']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);


    //Validate parameters
    if (!$dni) {
        $errors[] = 'DNI section is empty';
    }
    if (!$firstname) {
        $errors[] = 'Firstname section is empty';
    }
    if (!$surname) {
        $errors[] = 'Surname section is empty';
    }
    if (!$email) {
        $errors[] = 'Email section is empty';
    }
    if (!$phone_number) {
        $errors[] = 'Phone number section is empty';
    }

    //Check array erros is empty
    if (empty($errors)) {
        // write query
        $sql = "UPDATE 039_reservations SET dni = '$dni', firstname = '$firstname', surname = '$surname',";
        $sql .=" email = '$email', phone_number = $phone_number WHERE ID_reservation = $id;";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: /DWES/hotel_039/reservations.php?msg=3');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    // close connection
    mysqli_close($conn);
};
