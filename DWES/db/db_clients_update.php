<?php

include ($_SERVER['DOCUMENT_ROOT'].'/dwes/db/connect_db.php');

$errors = [];

//get id from url
$id = $_GET['result'];
$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

// write query
$sql = "SELECT * FROM 039_clients WHERE ID_client = '$id'";

// make query and result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$client_selected = mysqli_fetch_assoc($result);

// free result from memory
mysqli_free_result($result);

//get client_data
$dni = $client_selected['dni'];
$firstname = $client_selected['firstname'];
$surname = $client_selected['surname'];
$email = $client_selected['email'];
$phone_number = $client_selected['phone_number'];


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
        $sql = "UPDATE 039_clients SET dni = '$dni', firstname = '$firstname', surname = '$surname',";
        $sql .=" email = '$email', phone_number = $phone_number WHERE ID_client = $id;";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: /dwes/clients.php?msg=3');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    // close connection
    mysqli_close($conn);
};
