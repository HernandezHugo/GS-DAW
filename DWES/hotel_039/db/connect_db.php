<?php

//Connect to database
$conn = mysqli_connect('localhost','root','','039_hotel');

//check connection
if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
};

?>