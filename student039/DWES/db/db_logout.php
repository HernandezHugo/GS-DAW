<?php

include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');

session_start();
unset($_SESSION['user']);
session_unset();
header('Location: /student039/dwes/index.php');
