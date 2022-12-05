<?php

$available_categories = [];

if (isset($_POST['submit'])) {

    $initial_date = mysqli_real_escape_string($conn, $_POST['initial_date']);
    $final_date = mysqli_real_escape_string($conn, $_POST['final_date']);

    $sql = "CALL availableCategoriesByDate('$initial_date', '$final_date')";

    $result = mysqli_query($conn, $sql);

    // write query
    $sql = "SELECT * FROM 039_categories_to_show";

    // make query and result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $available_categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);
};
