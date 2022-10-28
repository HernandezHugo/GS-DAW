<?php
require ($_SERVER['DOCUMENT_ROOT'].'/DWES/templates/header.php');
include ($_SERVER['DOCUMENT_ROOT'].'/DWES/db/db_clients_delete.php');

?>

<?php if ($client_selected) : ?>
    <div class="container my-5">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone number</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($client_selected as $client_data) : ?>
                        <td>
                            <?php echo $client_data; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
        <p class="text-center mt-3">Are you sure you want to delete this client?</p>
        <form class="d-flex justify-content-center" action="" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $id_client ?>">
            <input type="submit" name="delete" class="btn btn-danger my-3 mx-auto" value="DELETE">
        </form>
    </div>
<?php endif; ?>
<?php
require ($_SERVER['DOCUMENT_ROOT'].'/DWES/templates/footer.php');
?>