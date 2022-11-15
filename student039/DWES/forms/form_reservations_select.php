<?php
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_reservations_select.php');


?>

<div class="container bg-light my-5">

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label" for="ID_reservation">ID reservation:</label>
            <input class="form-control form-control-sm" type="number" name="ID_reservation">
            <input class="btn btn-outline-primary my-3" type="submit" name="submit" value="Submit">
        </div>
    </form>
</div>

<?php if ($reservation_selected) : ?>
    <div class="container my-5">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"># Client</th>
                    <th scope="col"># Room</th>
                    <th scope="col">Initial date</th>
                    <th scope="col">Final date</th>
                    <th scope="col">Guests</th>
                    <th scope="col">Total price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($reservation_selected as $reservation_data) : ?>
                        <td>
                            <?php echo $reservation_data; ?>
                        </td>
                    <?php endforeach; ?>
                    <td>
                        <a class="w-100 m-1 btn btn-outline-warning btn-sm" href="/student039/dwes/forms/form_reservations_update.php?result=<?php echo $_POST['ID_reservation'] ?>">Update</a>
                        <a class="w-100 m-1 btn btn-outline-danger btn-sm" href="/student039/dwes/forms/form_reservations_delete.php?result=<?php echo $_POST['ID_reservation'] ?>">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>