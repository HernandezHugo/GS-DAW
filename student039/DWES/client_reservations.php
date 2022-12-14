<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_checkin.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_checkout.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_cancel.php');


//msg success at insert
$msg = $_GET['msg'] ?? null;

$id_client = $_SESSION['user_id'];

// write query
$sql = "SELECT * FROM 039_reservations WHERE ID_client = $id_client";
// make query and result
$result = mysqli_query($conn, $sql);
// fetch the resulting rows as an array
$reservations = mysqli_fetch_all($result, MYSQLI_ASSOC);
// free result from memory
mysqli_free_result($result);

?>

<h1 class="text-center mt-3">My reservations</h1>

<div class="container my-5">

    <?php if ($msg == 1) : ?>
        <p class="text-center text-white fw-bold mt-1  bg-success">
            <?php echo 'Check-in succeeded'; ?>
        </p>
    <?php elseif ($msg == 2) : ?>
        <p class="text-center text-white fw-bold mt-1  bg-success">
            <?php echo 'Check-out succeeded'; ?>
        </p>
    <?php elseif ($msg == 3) : ?>
        <p class="text-center text-white fw-bold mt-1  bg-success">
            <?php echo 'Cancellation succeeded'; ?>
        </p>
    <?php endif; ?>
    <?php if ($reservations) : ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"># Client</th>
                    <th scope="col"># Room</th>
                    <th scope="col"># Category</th>
                    <th scope="col">Initial date</th>
                    <th scope="col">Final date</th>
                    <th scope="col">Guests</th>
                    <th scope="col">Total price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation) : ?>
                    <tr>
                        <?php
                        $id = $reservation['ID_reservation'];
                        $category = $reservation['ID_category'];
                        foreach ($reservation as $reservation_data) : ?>
                            <td>
                                <?php
                                echo $reservation_data ?? 'No room assigned'; ?>
                            </td>
                        <?php endforeach; ?>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="id_reservation" value="<?php echo $id ?>">
                                <input type="hidden" name="id_category" value="<?php echo $category ?>">
                                <button type="submit" name="checkin" class="w-100 m-1 btn btn-outline-warning btn-sm">Check-in</button>
                                <button type="submit" name="checkout" class="w-100 m-1 btn btn-outline-warning btn-sm">Check-out</button>
                                <button type="submit" name="cancel" class="w-100 m-1 btn btn-outline-danger btn-sm">Cancel</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/footer.php');
?>