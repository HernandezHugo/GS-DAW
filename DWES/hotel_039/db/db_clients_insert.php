<?php

include 'connect_db.php';


if (isset($_GET['submit'])) {

    $dni = mysqli_real_escape_string($conn, $_GET['dni']);
    $firstname = mysqli_real_escape_string($conn, $_GET['firstname']);
    $surname = mysqli_real_escape_string($conn, $_GET['surname']);
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $phone_number = mysqli_real_escape_string($conn, $_GET['phone_number']);

    // write query
    $sql = "INSERT INTO 039_clients ( dni, firstname, surname, email, phone_number)";
    $sql .= "VALUES('$dni','$firstname','$surname','$email','$phone_number');";

    //save to db and check
    if (mysqli_query($conn, $sql)) {
        //success
        
    } else {
        //error
        echo 'query error: ' . mysqli_error($conn);
    }    

    // close connection
    mysqli_close($conn);
};
