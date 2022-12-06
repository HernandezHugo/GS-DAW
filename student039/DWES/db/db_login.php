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
        $sql = "SELECT * FROM 039_clients WHERE email = '$login_name' AND pwd = '$pwd';";
        $result = mysqli_query($conn, $sql);

        //check if user exists
         if ($result->num_rows) {
            $client= mysqli_fetch_assoc($result);
            $_SESSION['type'] = $type_client;
            $_SESSION['user_id'] = $client['ID_client'];
            $_SESSION['user_email'] = $client['email'];
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
