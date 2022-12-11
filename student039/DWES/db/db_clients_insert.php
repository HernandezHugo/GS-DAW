<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

$errors = [];

$dni = '';
$firstname = '';
$surname = '';
$email = '';
$phone_number = '';
$birthday = '';

if (isset($_POST['submit'])) {

    $dni = mysqli_real_escape_string($conn, $_POST['dni']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $re_pwd = mysqli_real_escape_string($conn, $_POST['re_pwd']);

    //Validate parameters

    if (!$dni) {
        $errors[] = 'Dni section is empty';
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
    if (!$birthday) {
        $errors[] = 'Birthday section is empty';
    }
    if (!$pwd) {
        $errors[] = 'Password section is empty';
    }
    if ($pwd != $re_pwd) {
        $errors[] = 'Re-password and password are not matching';
    }

    //Check array erros is empty
    if (empty($errors)) {
        // write query
        $sql = "SELECT * FROM 039_clients WHERE email = '$email';";
        $result_email = mysqli_query($conn, $sql);

        //make sure email is not registered yet
        if ($result_email->num_rows) {
            $errors[] = 'This Email is already registered';
        } else {
            //write query
            $sql = "INSERT INTO 039_clients (dni, firstname, surname, email, phone_number, birthday, pwd)";
            $sql .= "VALUES ('$dni', '$firstname', '$surname', '$email', $phone_number,'$birthday', '$pwd');";
            //save to db and check
            if (mysqli_query($conn, $sql)) {
                //success
                header('Location: /student039/dwes/index.php');
            } else {
                //error
                echo 'query error: ' . mysqli_error($conn);
            }
        }
        //free result
        mysqli_free_result($result_email);
    }
    // close connection
    mysqli_close($conn);
};
