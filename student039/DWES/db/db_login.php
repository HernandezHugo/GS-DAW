<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

$errors = [];

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    //Validate parameters

    if (!$email) {
        $errors[] = 'Email section is empty';
    }
    if (!$pwd) {
        $errors[] = 'Password section is empty';
    }

    //Check array erros is empty
    if (empty($errors)) {
        // write query

        $sql = "SELECT * FROM 039_users WHERE email = '$email' AND pwd = '$pwd';";

        $result = mysqli_query($conn, $sql);

        //check if user exists
        if ($result->num_rows) {
            //success
            $_SESSION['user'] = mysqli_fetch_assoc($result);
            header('Location: /student039/dwes/index.php');
        } else {
            //error
            $errors[] = 'Email or password are wrong';
        }
        mysqli_free_result($result);
    }

    // close connection
    mysqli_close($conn);
};
