<?php

include ($_SERVER['DOCUMENT_ROOT'].'/DWES/db/connect_db.php');

$errors = [];

//get id from url
$id = $_GET['result'];
$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

// write query
$sql = "SELECT * FROM 039_rooms WHERE ID_room = '$id'";

// make query and result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$room_selected = mysqli_fetch_assoc($result);

// free result from memory
mysqli_free_result($result);

//get room_data
$name = $room_selected['name_room'];
$capacity = $room_selected['capacity'];

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
        $sql = "UPDATE 039_rooms SET name_room = '$name', capacity = '$capacity'";
        $sql .=" WHERE ID_room = $id;";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: /DWES/rooms.php?msg=3');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    // close connection
    mysqli_close($conn);
};
