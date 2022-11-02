<?php
require ($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/templates/header.php');
include ($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/db/db_clients_update.php');

?>

<h1 class="text-center mt-3">Update client</h1>

<div class="container bg-light mt-3 w-75">
    <form class="mt-3 " action="" method="POST">
        <label class="form-label mt-3" for="">DNI (xxxxxxxxL)</label>
        <input class="form-control form-control-sm " type="text" name="dni" value="<?php echo $dni; ?>">

        <label class="form-label mt-3" for="">Firstname</label>
        <input class="form-control form-control-sm " type="text" name="firstname" value="<?php echo $firstname; ?>">

        <label class="form-label mt-3" for="">Surname</label>
        <input class="form-control form-control-sm " type="text" name="surname" value="<?php echo $surname; ?>">

        <label class="form-label mt-3" for="">Email</label>
        <input class="form-control form-control-sm " type="email" name="email" value="<?php echo $email; ?>">

        <label class="form-label mt-3" for="">Phone number (xxxxxxxxx)</label>
        <input class="form-control form-control-sm " type="number" name="phone_number" value="<?php echo $phone_number; ?>">

        <input class="my-3 btn btn-outline-primary btn-sm" type="submit" name="submit" value="Submit">
    </form>

    <?php foreach ($errors as $error) : ?>
        <p class="text-center text-white fw-bold mb-3  bg-danger">
            <?php echo $error; ?>
        </p>
    <?php endforeach; ?>

</div>
<?php
require ($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/templates/footer.php');
?>