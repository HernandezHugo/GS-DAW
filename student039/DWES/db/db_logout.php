<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

session_start();
session_unset();
$_SESSION['type'] = $type_default;
header('Location: /student039/dwes/index.php');
