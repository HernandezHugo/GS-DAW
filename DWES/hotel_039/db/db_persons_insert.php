<?php

include 'connect_db.php';


if (isset($_GET['submit'])) {

    $dni = mysqli_real_escape_string($conn, $_GET['dni']);
    $firstname = mysqli_real_escape_string($conn, $_GET['firstname']);
    $surname = mysqli_real_escape_string($conn, $_GET['surname']);
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $birthday = mysqli_real_escape_string($conn, $_GET['birthday']);
    $phone_number = mysqli_real_escape_string($conn, $_GET['phone_number']);


    // write query
    $sql = "INSERT INTO 039_persons (ID_persons, DNI, firstname, surname, email, birthday, phone_number)";
    $sql .= "VALUES('DEFAULT','$dni','$firstname','$surname','$email','$birthday','$phone_number');";

    //save to db and check
    if (mysqli_query($conn, $sql)) {
        //success
        
    } else {
        //error
        echo 'query error: ' . mysqli_error($conn);
    }
    // make query and result
    $result = mysqli_query($conn, $sql);

    // free result from memory
    //mysqli_free_result($result);

    // close connection
    mysqli_close($conn);
};
