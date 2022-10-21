<?php
require '../templates/header.php';
include '../db/db_clients_update.php';

?>
<div class="container bg-light my-5">

    <form action="" method="GET">
        <label for="">ID client:</label>
        <input type="number" name="ID_client">
        <br>
        <input type="submit" name="submit" value="submit">
    </form>

</div>
<?php if ($client) : ?>
    <div class="container mt-3">
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
                    <p>Número</p>
                </div>
            </div>
            <?php foreach ($client[0] as $client_data) : ?>

                <div class="col">
                    <?php echo $client_data; ?>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="container bg-light mt-3">

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
            <label for="">phone number (xxxxxxxxx)</label>
            <input type="number" name="phone_number">
            <br>
            <input type="submit" name="submit" value="submit">
        </form>
    </div>
<?php endif; ?>

<?php
require '../templates/footer.php';
?>