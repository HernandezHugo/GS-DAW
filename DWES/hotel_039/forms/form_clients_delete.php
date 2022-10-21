<?php
require '../templates/header.php';
include '../db/db_clients_delete.php';

?>
<div class="container bg-light my-5">

    <form action="" method="GET">
        <label for="">ID client:</label>
        <input type="number" name="ID_client">
        <br>
        <input type="submit" name="submit" value="submit">
    </form>

</div>

<?php
require '../templates/footer.php';
?>