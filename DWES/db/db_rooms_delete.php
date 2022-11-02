<?php

include ($_SERVER['DOCUMENT_ROOT'].'/dwes/db/connect_db.php');

$room_selected = [];
$id_room = '';

if (isset($_GET['result'])) {

    $id_room = mysqli_real_escape_string($conn, $_GET['result']);

    // write query
    $sql = "SELECT * FROM 039_rooms WHERE ID_room = '$id_room'";

    // make query and result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $room_selected = mysqli_fetch_assoc($result);

    // free result from memory
    mysqli_free_result($result);
};

if (isset($_POST['delete'])) {

    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    // write query
    $sql = "DELETE FROM 039_rooms WHERE ID_room = '$id_to_delete'";

    //delete from db and check
    if (mysqli_query($conn, $sql)) {
        //success
        header('Location: /dwes/rooms.php?msg=2');
    } else {
        //error
        echo 'query error: ' . mysqli_error($conn);
    }

    // close connection
    mysqli_close($conn);
};
