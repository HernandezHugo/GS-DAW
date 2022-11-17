<?php

session_start();
$_SESSION['type'] = 'guest';

/* var_dump($_SESSION);
exit; */

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <title>hotelsito</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/student039/dwes/index.php">Hotelsito</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <?php
        switch ($_SESSION['type']) {
          case 'guest':
            include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/nav_guest.php');
            break;
          case 'hugo':
            include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/nav_user.php');
            break;
          case 'dwesteacher':
            include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/nav_admin.php');
            break;
        }

        //Configure navs and login
        ?>
        <!-- 
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/student039/dwes/index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/student039/dwes/#">About us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/student039/dwes/#">Awards</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/student039/dwes/#">Contact</a>
            </li>
            <? //php if (empty($_SESSION['user'])) : 
            ?>
              <li class="nav-item">
                <a class="nav-link" href="/student039/dwes/forms/form_login.php">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/student039/dwes/forms/form_register.php">Register</a>
              </li>
            <? //php else : 
            ?>
              <li class="nav-item">
                <a class="nav-link" href="/student039/dwes/clients.php">Clients</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/student039/dwes/rooms.php">Rooms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/student039/dwes/reservations.php">Reservations</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/student039/dwes/db/db_logout.php">Log out</a>
              </li>
            <? //php endif; 
            ?>
          </ul>
        </div> -->
      </div>
    </nav>
  </header>