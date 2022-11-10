<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

$errors = [];

if (isset($_POST['submit'])) {

    $login_name = mysqli_real_escape_string($conn, $_POST['login_name']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    //Validate parameters

    if (!$login_name) {
        $errors[] = 'Username or email section is empty';
    }
    if (!$pwd) {
        $errors[] = 'Password section is empty';
    }

    //Check array erros is empty
    if (empty($errors)) {
        // write query
        // use regex to 
        $sql = "SELECT * FROM 039_users WHERE email = '$login_name' AND pwd = '$pwd';";
        $result_email = mysqli_query($conn, $sql);
        $sql = "SELECT * FROM 039_users WHERE username = '$login_name' AND pwd = '$pwd';";
        $result_username = mysqli_query($conn, $sql);

        //check if user exists
        if ($result_username->num_rows) {
            //success
            $_SESSION['user'] = mysqli_fetch_assoc($result_username);
            header('Location: /student039/dwes/index.php');
        } else if ($result_email->num_rows) {
            $_SESSION['user'] = mysqli_fetch_assoc($result_email);
            header('Location: /student039/dwes/index.php');
        } else {
            //error
            $errors[] = 'Email or password are wrong';
        }
        mysqli_free_result($result_email);
        mysqli_free_result($result_username);
    }

    // close connection
    mysqli_close($conn);
};
