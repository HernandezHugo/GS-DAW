<?php

//Connect to database
$conn = mysqli_connect('localhost','root','','039_hotel');
//$conn = mysqli_connect('remotehost.es','dwess1234','test1234.','dwesdatabase');

//check connection
if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
};
?>