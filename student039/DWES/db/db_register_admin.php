<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

$errors = [];

if (isset($_POST['submit'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $re_pwd = mysqli_real_escape_string($conn, $_POST['re_pwd']);

    //Validate parameters

    if (!$username) {
        $errors[] = 'Username section is empty';
    }
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
        $sql = "SELECT * FROM 039_users WHERE email = '$email';";
        $result_email = mysqli_query($conn, $sql);
        $sql = "SELECT * FROM 039_users WHERE email = '$username';";
        $result_username = mysqli_query($conn, $sql);
        //make sure email is not registered yet
        if ($result_email->num_rows) {
            $errors[] = 'This Email is already registered';
        } else if ($result_username->num_rows) {
            $errors[] = 'This Username is already registered';
        } else {
            //write query
            $sql = "INSERT INTO 039_users (username, email, pwd)";
            $sql .= "VALUES ('$username', '$email', '$pwd');";
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
        mysqli_free_result($result_username);
    }
    // close connection
    mysqli_close($conn);
};
