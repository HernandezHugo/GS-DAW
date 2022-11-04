<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

$errors = [];

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $re_pwd = mysqli_real_escape_string($conn, $_POST['re_pwd']);


    //Validate parameters

    if (!$email) {
        $errors[] = 'Email section is empty';
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

        $sql = "INSERT INTO 039_users (email, pwd)";
        $sql .= "VALUES ('$email', '$pwd');";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: /student039/dwes/index.php');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
            $errors[] = 'This Email is already registered';
        }
    }

    // close connection
    mysqli_close($conn);
};
