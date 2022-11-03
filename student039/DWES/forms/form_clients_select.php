<?php
include ($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/db/db_clients_select.php');
?>

<div class="container bg-light my-5">

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label" for="ID_client">ID client:</label>
            <input class="form-control form-control-sm" type="number" name="ID_client">
            <input class="btn btn-outline-primary my-3" type="submit" name="submit" value="Submit">
        </div>
    </form>
</div>

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
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($client_selected as $client_data) : ?>
                        <td>
                            <?php echo $client_data; ?>
                        </td>
                    <?php endforeach; ?>
                    <td>
                        <a class="w-100 m-1 btn btn-outline-warning btn-sm" href="/student039/dwes/forms/form_clients_update.php?result=<?php echo $_POST['ID_client'] ?>">Update</a>
                        <a class="w-100 m-1 btn btn-outline-danger btn-sm" href="/student039/dwes/forms/form_clients_delete.php?result=<?php echo $_POST['ID_client'] ?>">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>