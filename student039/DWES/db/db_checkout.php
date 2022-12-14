<?php

include ($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/db/connect_db.php');

if (isset($_POST['checkout'])) {
    
    $id_reservation = mysqli_real_escape_string($conn, $_POST['id_reservation']);

    $sql = "SELECT ID_status FROM 039_status WHERE status_name = 'checkout';";
    $result = mysqli_query($conn, $sql);
    $id_status = mysqli_fetch_assoc($result)['ID_status'];
    mysqli_free_result($result);

    //Check array erros is empty
    if ($id_status) {
        // write query
        $sql = "UPDATE 039_reservations SET  ID_status = '$id_status' WHERE ID_reservation = '$id_reservation';";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: /student039/dwes/reservations.php?msg=2');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    // close connection
    mysqli_close($conn);
};
