<?php

$room_selected = [];

if (isset($_POST['submit'])) {

    $id_room = mysqli_real_escape_string($conn, $_POST['ID_room']);

    // write query
    $sql = "SELECT * FROM 039_rooms WHERE ID_room = '$id_room'";

    // make query and result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $room_selected = mysqli_fetch_assoc($result);

    // free result from memory
    mysqli_free_result($result);
    
    // close connection
    mysqli_close($conn);
};
