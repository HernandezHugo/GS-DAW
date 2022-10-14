<?php
require '../templates/header.php';
include '../db/db_persons_select.php';

?>
<div class="container bg-light my-5">

    <form action="" method="GET">
        <label for="">ID persons:</label>
        <input type="number" name="ID_persons">
        <br>
        <input type="submit" name="submit" value="submit">
    </form>

</div>
<?php if ($person) : ?>
    <div class="container my-5">
        <div class="row bg-light">
            <div class="row">
                <div class="col">
                    <p>ID</p>
                </div>
                <div class="col">
                    <p>DNI</p>
                </div>
                <div class="col">
                    <p>Nombre</p>
                </div>
                <div class="col">
                    <p>Apellido</p>
                </div>
                <div class="col">
                    <p>Email</p>
                </div>
                <div class="col">
                    <p>Cumpleaños</p>
                </div>
                <div class="col">
                    <p>Número</p>
                </div>
                <div class="col">
                    <p>Posición</p>
                </div>

            </div>
            <?php foreach ($person[0] as $person_data) : ?>

                <div class="col">
                    <?php echo $person_data; ?>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php
require '../templates/footer.php';
?>