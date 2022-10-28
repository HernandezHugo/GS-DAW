<?php

//include($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/index.php);

//Connect to database
$conn = mysqli_connect('localhost','root','','039_hotel');
//$conn = mysqli_connect('dwesdatabase','dwess1234','test1234.','039_hotel');

//check connection
if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
};
?>