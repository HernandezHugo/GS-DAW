<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

$errors = [];

$name = '';
$capacity = '';


if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
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
        $sql = "SELECT * FROM 039_categories WHERE category_name = '$name';";
        // make query and result
        $result = mysqli_query($conn, $sql);
        // fetch the resulting rows as an array
        $category = mysqli_fetch_assoc($result);
        // free result from memory
        mysqli_free_result($result);

        // write query
        $sql = "INSERT INTO 039_rooms ( ID_category, capacity)";
        $sql .= "VALUES( {$category['ID_category']} , $capacity);";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: /student039/dwes/rooms.php?msg=1');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }
};
