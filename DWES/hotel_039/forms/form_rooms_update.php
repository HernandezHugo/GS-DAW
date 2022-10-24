<?php
require '../templates/header.php';
include '../db/db_rooms_update.php';

?>

<h1 class="text-center mt-3">Update room</h1>

<div class="container bg-light mt-3 w-75">
    <form class="mt-3 " action="" method="POST">
        <label class="form-label mt-3" for="">Name</label>
        <input class="form-control form-control-sm " type="text" name="name_room" value="<?php echo $name; ?>">

        <label class="form-label mt-3" for="">Capacity</label>
        <select class="input-group" name="capacity">
            <option value="<?php echo $capacity; ?>" selected><?php echo $capacity; ?></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>

        <input class="my-3 btn btn-outline-primary btn-sm" type="submit" name="submit" value="Submit">
    </form>

    <?php foreach ($errors as $error) : ?>
        <p class="text-center text-white fw-bold mb-3  bg-danger">
            <?php echo $error; ?>
        </p>
    <?php endforeach; ?>

</div>
<?php
require '../templates/footer.php';
?>