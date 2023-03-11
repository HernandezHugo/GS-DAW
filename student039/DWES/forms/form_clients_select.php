<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_clients_select.php');
?>

<div class="container bg-light my-5">

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label" for="Client_name">Client name:</label>
            <input id="client_input" class="form-control form-control-sm" type="text" name="Client_name" oninput="getClients()">
        </div>
    </form>
</div>

    <div id="show_clients_container" class="container my-5">
    </div>