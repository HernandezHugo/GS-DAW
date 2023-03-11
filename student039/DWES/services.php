<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_services_insert.php');

if ($_SESSION['type'] == $type_client) {

    $id_client = $_SESSION['user_id'];
    // write query
    $sql = "SELECT * FROM 039_reservations WHERE ID_client = $id_client AND ID_status = 2;"; //checked in
} else  {

    // write query
    $sql = "SELECT * FROM 039_reservations WHERE ID_status = 2"; //checked in
}

// make query and result
$result = mysqli_query($conn, $sql);
// fetch the resulting rows as an array
$reservations = mysqli_fetch_all($result, MYSQLI_ASSOC);
// free result from memory
mysqli_free_result($result);

// write query
$sql = "SELECT * FROM 039_services";
// make query and result
$result = mysqli_query($conn, $sql);
// fetch the resulting rows as an array
$services = mysqli_fetch_all($result, MYSQLI_ASSOC);
// free result from memory
mysqli_free_result($result);


?>
<?php foreach ($errors as $error) : ?>
    <p class="text-center text-white fw-bold mb-3  bg-danger">
        <?php echo $error; ?>
    </p>
<?php endforeach; ?>
<form class="container" method="POST">
    <div class="row p-5">
        <div class="col">
            <label class="form-label mt-3">Reservation</label>
            <select class="form-select" aria-label="Default select example" name="id_reservation">
                <option value="" selected></option>
                <?php foreach ($reservations as $reservation) : ?>
                    <option value="<?php echo $reservation['ID_reservation']; ?>">
                        <?php echo $reservation['ID_client']; ?> -
                        <?php echo $reservation['initial_date']; ?> -
                        <?php echo $reservation['final_date']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row p-3">
        <?php foreach ($services as $service) : ?>
            <div class="col d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo './img/' . $service['service_name'] . '.jpg'; ?>" class="card-img-top" alt="<?php echo $service['service_name']; ?> image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $service['service_name']; ?></h5>
                        <p class="card-text"><?php echo $service['service_price']; ?> €</p>
                        <div class="d-flex justify-content-between">
                            <input class="form-check-input" type="checkbox" name="check_list[<?php echo $service['ID_service']; ?>]" value="<?php echo $service['service_name']; ?>">
                            <input type="number" name="qty_list[<?php echo $service['service_name']; ?>]" min="0" max="10" placeholder="0">
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <input class="my-3 btn btn-outline-primary" type="submit" name="submit" value="Submit">
        </div>
    </div>
</form>


<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/footer.php');
?>

</body>

</html>