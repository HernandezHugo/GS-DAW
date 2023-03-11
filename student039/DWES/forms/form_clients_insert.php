<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_clients_insert.php');

?>

<h1 class="text-center mt-3">Insert client</h1>

<div class="container bg-light mt-3 w-75">
    <form class="mt-3 " action="" method="POST">
        <label class="form-label mt-3">DNI (xxxxxxxxL)</label>
        <input class="form-control form-control-sm " type="text" name="dni" value="<?php echo $dni; ?>">

        <label class="form-label mt-3">Firstname</label>
        <input class="form-control form-control-sm " type="text" name="firstname" value="<?php echo $firstname; ?>">

        <label class="form-label mt-3">Surname</label>
        <input class="form-control form-control-sm " type="text" name="surname" value="<?php echo $surname; ?>">

        <label class="form-label mt-3">Email</label>
        <input class="form-control form-control-sm " type="email" name="email" value="<?php echo $email; ?>">

        <label class="form-label mt-3">Phone number (xxxxxxxxx)</label>
        <input class="form-control form-control-sm " type="number" name="phone_number" value="<?php echo $phone_number; ?>">

        <label class="form-label mt-3">Birthday</label>
        <input type="date" name="birthday" value="<?php echo $birthday; ?>">
        <br>

        <label class="form-label mt-3">Password </label>
        <input class="form-control form-control-sm " type="password" name="pwd">

        <label class="form-label mt-3">Re-password </label>
        <input class="form-control form-control-sm " type="password" name="re_pwd">

        <input class="my-3 btn btn-outline-primary btn-sm" type="submit" name="submit" value="Submit">
    </form>

    <?php foreach ($errors as $error) : ?>
        <p class="text-center text-white fw-bold mb-3  bg-danger">
            <?php echo $error; ?>
        </p>
    <?php endforeach; ?>

</div>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/footer.php');
?>

</body>

</html>