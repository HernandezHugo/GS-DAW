<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_reservations_delete.php');

?>

<?php if ($reservation_selected) : ?>
    <div class="container my-5">
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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($reservation_selected as $reservation_data) : ?>
                        <td>
                            <?php echo $reservation_data; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
        <p class="text-center mt-3">Are you sure you want to delete this reservation?</p>
        <form class="d-flex justify-content-center" action="" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $id_reservation ?>">
            <input type="submit" name="delete" class="btn btn-danger my-3 mx-auto" value="DELETE">
        </form>
    </div>
<?php endif; ?>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/footer.php');
?>