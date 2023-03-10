<?php 

if(isset($_POST["submit"])){


    $initial_date = mysqli_real_escape_string($conn, $_POST['initial_date']);
    $final_date = mysqli_real_escape_string($conn, $_POST['final_date']);

    setcookie("initial_date", $initial_date, ["samesite" => "Lax", "expires" => time() + 86400]);
    setcookie("final_date", $final_date, ["samesite" => "Lax", "expires" => time() + 86400]);

}