<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

$q = $_GET['q'];
$i = $_GET['i'];
$f = $_GET['f'];


if ($q !== "" && $i !== "" && $f !== "") {

    $num_days = abs(strtotime($i) - strtotime($f)) / 86400;

    // write query
    $sql = "SELECT category_price FROM 039_categories WHERE ID_category = $q";
    // make query and result
    $result = mysqli_query($conn, $sql);
    // fetch the resulting rows as an array
    $category = mysqli_fetch_assoc($result);
    // free result from memory
    mysqli_free_result($result);

    echo json_encode($category['category_price'] * $num_days);
}
