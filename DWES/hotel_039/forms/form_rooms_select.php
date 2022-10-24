<?php
include './db/db_rooms_select.php';


?>

<div class="container bg-light my-5">

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label" for="ID_room">ID room:</label>
            <input class="form-control form-control-sm" type="number" name="ID_room">
            <input class="btn btn-outline-primary my-3" type="submit" name="submit" value="Submit">
        </div>
    </form>
</div>

<?php if ($room_selected) : ?>
    <div class="container my-5">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Capacity</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($room_selected as $room_data) : ?>
                        <td>
                            <?php echo $room_data; ?>
                        </td>
                    <?php endforeach; ?>
                    <td>
                        <a class="w-100 m-1 btn btn-outline-warning btn-sm" href="./forms/form_rooms_update.php?result=<?php echo $_POST['ID_room'] ?>">Update</a>
                        <a class="w-100 m-1 btn btn-outline-danger btn-sm" href="./forms/form_rooms_delete.php?result=<?php echo $_POST['ID_room'] ?>">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>