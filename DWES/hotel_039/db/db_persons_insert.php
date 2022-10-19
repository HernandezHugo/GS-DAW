<?php

include 'connect_db.php';


if (isset($_GET['submit'])) {
    //echo $_GET['ID_persons'];
    print_r($_GET);

   /*  $dni = mysqli_real_escape_string($conn, $_GET['dni']);
    $firstname = mysqli_real_escape_string($conn, $_GET['firstname']);
    $surname = mysqli_real_escape_string($conn, $_GET['surname']);
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $birthday = mysqli_real_escape_string($conn, $_GET['birthday']);
    $phone_number = mysqli_real_escape_string($conn, $_GET['phone_number']);
    $position = mysqli_real_escape_string($conn, $_GET['position']);
    if ($position == '0') {
        $position = 'NULL';
    }; */

    // write query
    //$sql = "INSERT INTO 039_persons (ID_persons, DNI, firstname, surname, email, birthday, phone_number, ID_position)" .
       // "VALUES('DEFAULT','$dni','$firstname','$surname','$email','$birthday','$phone_number', '$position');";

    // make query and result
    $result = mysqli_query($conn, $sql);

    // free result from memory
    //mysqli_free_result($result);

    // close connection
    mysqli_close($conn);

    
};
