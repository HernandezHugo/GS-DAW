<?php

$errors = [];

if (isset($_POST['submit'])) {

    $id_reservation = mysqli_real_escape_string($conn, $_POST['id_reservation']);

    if(!$id_reservation){
        $errors[] = 'Reservartion not specified';
    }
    if(!in_array('check_list', array_keys($_POST))){
        $errors[] = 'Services not specified';
    }

    if ($id_reservation && in_array('check_list', array_keys($_POST))) {
        foreach ($_POST['check_list'] as $service_name) {
            
            $name_service = mysqli_real_escape_string($conn, $service_name);
            $quantity = mysqli_real_escape_string($conn, $_POST['qty_list'][$name_service]);
            
            if(!$quantity) continue;
            $sql = "CALL 039_addToCart($id_reservation, '$name_service', $quantity)";
            
            $result = mysqli_query($conn, $sql);
        }
    }
}
