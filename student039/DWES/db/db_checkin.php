<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

if (isset($_POST['checkin'])) {

    $id_reservation = mysqli_real_escape_string($conn, $_POST['id_reservation']);
    $id_category = mysqli_real_escape_string($conn, $_POST['id_category']);

    //Get a random room ID
    $sql = "SELECT ID_room FROM 039_rooms WHERE ID_category = $id_category ORDER BY RAND() LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    $id_room = mysqli_fetch_assoc($result)['ID_room'];
    mysqli_free_result($result);

    $sql = "SELECT ID_status FROM 039_status WHERE status_name = 'checkin';";
    $result = mysqli_query($conn, $sql);
    $id_status = mysqli_fetch_assoc($result)['ID_status'];
    mysqli_free_result($result);

    //Check array erros is empty
    if ($id_room && $id_status) {
        // write query
        $sql = "UPDATE 039_reservations SET  ID_room = '$id_room', ID_status = '$id_status' WHERE ID_reservation = '$id_reservation';";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: /student039/dwes/reservations.php?msg=1');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    // close connection
    mysqli_close($conn);
};
