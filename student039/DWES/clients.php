<?php
require ($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/templates/header.php');
include ($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/db/connect_db.php');

//msg success at insert
$msg = $_GET['msg'] ?? null;


// write query
$sql = "SELECT * FROM 039_clients";
// make query and result
$result = mysqli_query($conn, $sql);
// fetch the resulting rows as an array
$clients = mysqli_fetch_all($result, MYSQLI_ASSOC);
// free result from memory
mysqli_free_result($result);

?>

<h1 class="text-center mt-3">Section Clients</h1>

<?php
include ($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/forms/form_clients_select.php');
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
    <a class="m-1 btn btn-outline-success btn-sm" href="forms/form_clients_insert.php">Insert client</a>
    <?php if ($clients) : ?>
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
                <?php foreach ($clients as $client) : ?>
                    <tr>
                        <?php
                        $id = $client['ID_client'];
                        foreach ($client as $client_data) : ?>
                            <td>
                                <?php echo $client_data; ?>
                            </td>
                        <?php endforeach; ?>
                        <td>
                            <a class="w-100 m-1 btn btn-outline-warning btn-sm" href="/student039/dwes/forms/form_clients_update.php?result=<?php echo $id ?>">Update</a>
                            <a class="w-100 m-1 btn btn-outline-danger btn-sm" href="/student039/dwes/forms/form_clients_delete.php?result=<?php echo $id ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
require ($_SERVER['DOCUMENT_ROOT'].'/student039/dwes/templates/footer.php');
?>