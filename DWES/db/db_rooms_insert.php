<?php

include ($_SERVER['DOCUMENT_ROOT'].'/DWES/db/connect_db.php');

$errors = [];

$name = '';
$capacity = '';


if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name_room']);
    $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);


    //Validate parameters
    if (!$name) {
        $errors[] = 'Name section is empty';
    }
    if (!$capacity) {
        $errors[] = 'Capacity section is empty';
    }

    //Check array erros is empty
    if (empty($errors)) {
        // write query
        $sql = "INSERT INTO 039_rooms ( name_room, capacity)";
        $sql .= "VALUES('$name', $capacity);";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: /DWES/rooms.php?msg=1');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    // close connection
    mysqli_close($conn);
};
