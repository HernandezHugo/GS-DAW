<?php

session_start();

$type_default = 'guest';
$type_admin = 'admin';
$type_client = 'client';

if (empty($_SESSION['type'])) {
  $_SESSION['type'] = $type_default;
}

//initialize Cookies
ob_start();
$cookie = $_COOKIE["use"] ?? 1;
$stateCookie = $_COOKIE["stateCookie"] ?? 0;

//setting our cookies that has been accepted
if (isset($_POST["settingCookie"])) {
  setcookie("stateCookie", 1);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="#">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/student039/dwes/css/style.css">
  <title>hotelsito</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">

        <a href="/student039/dwes/index.php"><img class="navbar-brand" src="/student039/dwes/img/logo_hotel_navbar.png" alt="logo Hotel"></a>
        <?php if($_SESSION['type'] == $type_admin):?>
        <img id="user_pfp" class="navbar-brand" src="/student039/dwes/user_pfp/<?php echo $_SESSION['user']['pfp']?>" alt="logo Hotel">
        <?php endif;?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <?php
        switch ($_SESSION['type']) {
          case $type_default:
            include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/nav_guest.php');
            break;
          case $type_client:
            include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/nav_client.php');
            break;
          case $type_admin:
            include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/nav_admin.php');
            break;
        }
        ?>
        </ul>
      </div>
      </div>
    </nav>
  </header>