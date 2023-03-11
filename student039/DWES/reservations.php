<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/verify_admin.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_checkout.php');

//msg success at insert
$msg = $_GET['msg'] ?? null;


// write query
$sql = "SELECT * FROM 039_reservations";
// make query and result
$result = mysqli_query($conn, $sql);
// fetch the resulting rows as an array
$reservations = mysqli_fetch_all($result, MYSQLI_ASSOC);
// free result from memory
mysqli_free_result($result);

?>

<h1 class="text-center mt-3">Section reservations</h1>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/forms/form_reservations_select.php');
?>

<div class="container my-5">

    <?php if ($msg == 1) : ?>
        <p class="text-center text-white fw-bold mt-1  bg-success">
            <?php echo 'Insert succeeded'; ?>
        </p>
    <?php elseif ($msg == 2) : ?>
        <p class="text-center text-white fw-bold mt-1  bg-success">
            <?php echo 'Delete succeeded'; ?>
        </p>
    <?php elseif ($msg == 3) : ?>
        <p class="text-center text-white fw-bold mt-1  bg-success">
            <?php echo 'Update succeeded'; ?>
        </p>
    <?php endif; ?>
    <a class="m-1 btn btn-outline-success btn-sm" href="/student039/dwes/forms/form_reservations_insert.php">Insert reservation</a>
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
                        $id_reservation = $reservation['ID_reservation'];
                        foreach ($reservation as $reservation_data) : ?>
                            <td>
                                <?php
                                echo $reservation_data ?? 'No room assigned'; ?>
                            </td>
                        <?php endforeach; ?>
                        <td>
                            <a class="w-100 m-1 btn btn-outline-warning btn-sm" href="/student039/dwes/forms/form_reservations_update.php?result=<?php echo $id_reservation ?>">Update</a>
                            <form method="POST">
                                <input type="hidden" name="id_reservation" value="<?php echo $id_reservation ?>">
                                <button type="submit" name="checkout" class="w-100 m-1 btn btn-warning btn-sm">Check-out</button>
                            </form>
                            <a class="w-100 m-1 btn btn-outline-danger btn-sm" href="/student039/dwes/forms/form_reservations_delete.php?result=<?php echo $id_reservation ?>">Delete</a>
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

</body>

</html>