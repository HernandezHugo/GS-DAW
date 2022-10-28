<?php

include 'connect_db.php';

$errors = [];

$dni = '';
$firstname = '';
$surname = '';
$email = '';
$phone_number = '';


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
        $sql = "INSERT INTO 039_clients ( dni, firstname, surname, email, phone_number)";
        $sql .= "VALUES('$dni','$firstname','$surname','$email','$phone_number');";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: /DWES/hotel_039/clients.php?msg=1');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    // close connection
    mysqli_close($conn);
};
