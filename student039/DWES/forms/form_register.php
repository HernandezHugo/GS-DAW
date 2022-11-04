<?php
require ($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/templates/header.php');
include ($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/db/db_register.php');
?>

<div class="container bg-light mt-3 w-75">
    <form class="mt-3 " action="" method="POST">
        
        <label class="form-label mt-3" for="">Email</label>
        <input class="form-control form-control-sm " type="email" name="email">

        <label class="form-label mt-3" for="">Password</label>
        <input class="form-control form-control-sm " type="password" name="pwd">

        <label class="form-label mt-3" for="">Password</label>
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
require ($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/templates/footer.php');
?>