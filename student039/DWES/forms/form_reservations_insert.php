<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_reservations_insert.php');

?>

<h1 class="text-center mt-3">Insert reservation</h1>

<div class="container bg-light mt-3 w-75">
    <form class="mt-3 " action="" method="POST">
        <label class="form-label mt-3">Client</label>
        <select class="form-select" aria-label="Default select example" name="id_client">
            <option value="" selected></option>
            <?php foreach ($clients as $client) : ?>
                <option value="<?php echo $client['ID_client']; ?>"><?php echo $client['firstname']; ?></option>
            <?php endforeach; ?>
        </select>
        <label class="form-label mt-3">room</label>
        <select class="form-select" aria-label="Default select example" name="id_room">
            <option value="" selected></option>
            <?php foreach ($rooms as $room) : ?>
                <option value="<?php echo $room['ID_room']; ?>"><?php echo $room['name_room']; ?></option>
            <?php endforeach; ?>
        </select>
        <label class="form-label mt-3">category</label>
        <select class="form-select" aria-label="Default select example" name="id_category">
            <option value="" selected></option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['ID_category']; ?>"><?php echo $category['category_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label class="form-label mt-3">Initial date</label>
        <input type="date" name="initial_date">
        <label class="form-label mt-3">Final date</label>
        <input type="date" name="final_date">
        <br>
        <label class="form-label">Guests:</label>
        <input class="form-control form-control-sm" value="<?php echo $number_guests; ?>" type="number" name="number_guests" min="1" max="5" placeholder="1">
        <label class="form-label mt-3">Total price</label>
        <input type="number" name="total_price" value="<?php echo $total_price; ?>" class="form-control form-control-sm">
        <label class="form-label mt-3">Status</label>
        <input type="text" name="ID_status" value="<?php echo $id_status; ?>" class="form-control form-control-sm">
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
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/footer.php');
?>