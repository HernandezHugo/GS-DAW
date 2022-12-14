<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

if (isset($_POST['cancel'])) {

    $id_reservation = mysqli_real_escape_string($conn, $_POST['id_reservation']);

    //Get  reservation by ID
    $sql = "SELECT ID_reservation FROM 039_reservations WHERE ID_reservation = $id_reservation;";
    $result = mysqli_query($conn, $sql);
    $reservation_selected = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    //if id_room not cancel
    //if current date +7 = initial date not cancel


    //Check array erros is empty
    if ($id_room && $id_status) {
        // write query
        $sql = "UPDATE 039_reservations SET  ID_room = '$id_room', ID_status = '$id_status' WHERE ID_reservation = '$id_reservation';";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: /student039/dwes/reservations.php?msg=3');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    // close connection
    mysqli_close($conn);
};
