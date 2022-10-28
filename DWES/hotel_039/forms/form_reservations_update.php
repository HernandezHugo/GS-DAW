<?php
require '../templates/header.php';
include '../db/db_reservations_update.php';

?>

<h1 class="text-center mt-3">Update Reservation</h1>

<div class="container bg-light mt-3 w-75">
    <form class="mt-3 " action="" method="POST">
        <label class="form-label mt-3" for="">Client</label>
        <select class="input-group" name="id_client">
            <option value="<?php echo $id_client; ?>" selected><?php echo $client_selected['firstname']; ?></option>
            <?php foreach ($clients as $client) : ?>
                <option value="<?php echo $client['ID_client']; ?>"><?php echo $client['firstname']; ?></option>
            <?php endforeach; ?>
        </select>
        <label class="form-label mt-3" for="">room</label>
        <select class="input-group" name="id_room">
            <option value="<?php echo $id_room; ?>" selected><?php echo $room_selected['name_room']; ?></option>
            <?php foreach ($rooms as $room) : ?>
                <option value="<?php echo $room['ID_room']; ?>"><?php echo $room['name_room']; ?></option>
            <?php endforeach; ?>
        </select>

        <label class="form-label mt-3" for="">Initial date</label>
        <input type="date" name="initial_date" value="<?php echo $initial_date; ?>">
        <label class="form-label mt-3" for="">Final date</label>
        <input type="date" name="final_date" value="<?php echo $final_date; ?>">
        <br>
        <label class="form-label mt-3" for="">Total price</label>
        <input type="number" name="total_price" value="<?php echo $total_price; ?>" class="form-control form-control-sm">
        <label class="form-label mt-3" for="">Status</label>
        <input type="text" name="status_room" value="<?php echo $status_room; ?>" class="form-control form-control-sm">
        <br>

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