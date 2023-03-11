<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_reservations_insert.php');

?>

<h1 class="text-center mt-3">Insert reservation</h1>

<div class="container bg-light mt-3 w-75">
    <form class="mt-3 " action="" method="POST">
        <label class="form-label mt-3">Client</label>
        <select class="form-select" aria-label="Default select example" name="id_client">
            <?php foreach ($clients as $client) : ?>
                <option value="<?php echo $client['ID_client']; ?>"><?php echo $client['firstname'] . ' ' . $client['surname']; ?></option>
            <?php endforeach; ?>
        </select>
        <label class="form-label mt-3">category</label>
        <select id="category_selected_upd_ins" class="form-select" aria-label="Default select example" name="id_category" onchange="getRooms()">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['ID_category']; ?>"><?php echo $category['category_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <label class="form-label mt-3">room</label>
        <select id="show_rooms_reserv_ins" class="form-select" aria-label="Default select example" name="id_room">

        </select>

        <label class="form-label mt-3">Initial date</label>
        <input id="initial_date_reserv_upd_ins" onchange="getPrice()" type="date" name="initial_date">
        <label class="form-label mt-3">Final date</label>
        <input id="final_date_reserv_upd_ins" onchange="getPrice()" type="date" name="final_date">

        <br>
        <label class="form-label">Guests:</label>
        <input class="form-control form-control-sm" value="<?php echo $number_guests; ?>" type="number" name="number_guests" min="1" max="5" placeholder="How many guests?">
        <label class="form-label mt-3">Total price</label>
        <input id="show_price_reserv_upd_ins" type="number" name="total_price" value="" class="form-control form-control-sm">
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
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/ajax/ajax_rooms_reserv_upd_ins.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/ajax/ajax_price_reserv_upd_ins.php');
?>