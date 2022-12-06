<?php
if (isset($_POST['book'])) {

    $id_client = '';

    if ($_SESSION['type'] == 'guest') {

        header('Location: /student039/dwes/forms/form_login.php');
    } else if ($_SESSION['type'] == 'admin') {

        //Get a random client ID
        $sql = "SELECT ID_client FROM 039_clients ORDER BY RAND() LIMIT 1;";
        $result = mysqli_query($conn, $sql);
        $id_client = mysqli_fetch_assoc($result)['ID_client'];
        mysqli_free_result($result);

    } else if ($_SESSION['type'] == 'client') {

        //Get client ID
        $id_client = $_SESSION['user_id'];
    }

    //Get all information about the category chosen
    $book_id_category = mysqli_real_escape_string($conn, $_POST['book_id_category']);
    $book_initial_date = mysqli_real_escape_string($conn, $_POST['book_initial_date']);
    $book_final_date = mysqli_real_escape_string($conn, $_POST['book_final_date']);
    $book_capacity = mysqli_real_escape_string($conn, $_POST['book_capacity']);
    $book_price = mysqli_real_escape_string($conn, $_POST['book_price']);

    // write query
    $sql = "INSERT INTO 039_reservations ( ID_client,  ID_category, initial_date, final_date, number_guests, total_price)";
    $sql .= "VALUES('$id_client', '$book_id_category','$book_initial_date','$book_final_date','$book_capacity','$book_price' );";

    //save to db and check
    if (mysqli_query($conn, $sql)) {
        //success
        header('Location: /student039/dwes/booking.php');
    } else {
        //error
        echo 'query error: ' . mysqli_error($conn);
    }

    // close connection
    mysqli_close($conn);
}
