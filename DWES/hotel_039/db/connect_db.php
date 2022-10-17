<?php

//include($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/index.php);

//Connect to database
$conn = mysqli_connect('localhost','root','','039_hotel');
//$conn = mysqli_connect('localhost','root','','07_hotel');

//check connection
if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
};

?>