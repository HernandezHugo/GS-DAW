<?php

$reservation_selected = [];

if (isset($_POST['submit'])) {

    $initial_date = mysqli_real_escape_string($conn, $_POST['initial_date']);
    $final_date = mysqli_real_escape_string($conn, $_POST['final_date']);

    // write query
    $sql = "SELECT * FROM 039_categories WHERE ID_category NOT IN (
        SELECT ID_category FROM 039_reservations WHERE initial_date < '$initial_date' AND final_date > '$final_date'
    )";

    // make query and result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $reservation_selected = mysqli_fetch_assoc($result);

    // free result from memory
    mysqli_free_result($result);
    
    // close connection
    mysqli_close($conn);
};
