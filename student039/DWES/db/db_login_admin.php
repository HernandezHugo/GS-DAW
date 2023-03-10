<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

if ($_SESSION['type'] == $type_admin || $_SESSION['type'] == $type_client) {
    header('Location: /student039/dwes/index.php');
}

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
        $sql = "SELECT * FROM 039_users WHERE email = '$login_name' AND pwd = '$pwd'";
        $sql .= "OR username = '$login_name' AND pwd = '$pwd';";
        $result = mysqli_query($conn, $sql);

        //check if user exists
        if ($result->num_rows) {
            //success
            $user = mysqli_fetch_assoc($result);
            $_SESSION['type'] = $type_admin;
            $_SESSION['user'] = ['name' => $user['username'], 'pfp' => $user['user_pfp']];

            header('Location: /student039/dwes/index.php');
        } else {
            //error
            $errors[] = 'Email or password are wrong';
        }
        //mysqli_free_result($result_email);
        mysqli_free_result($result);
    }

    // close connection
    mysqli_close($conn);
};
