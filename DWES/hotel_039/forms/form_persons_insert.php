<?php
require '../templates/header.php';
include '../db/db_persons_insert.php';



?>
<div class="container bg-light">

    <form action="" method="get">
        <label for="">DNI (xxxxxxxxL)</label>
        <input type="text" name="dni">
        <br>
        <label for="">firstname</label>
        <input type="text" name="firstname">
        <br>
        <label for="">surname</label>
        <input type="text" name="surname">
        <br>
        <label for="">email</label>
        <input type="email" name="email">
        <br>
        <label for="">birthday (yyyy-mm-dd)</label>
        <input type="date" name="birthday">
        <br>
        <label for="">phone number (xxxxxxxxx)</label>
        <input type="number" name="phone_number">
        <br>
        <input type="submit" name="submit" value="submit">
    </form>
</div>

<?php
require '../templates/footer.php';
?>