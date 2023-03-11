<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_rooms_insert.php');

// write query
$sql = "SELECT * FROM 039_categories";
// make query and result
$result = mysqli_query($conn, $sql);
// fetch the resulting rows as an array
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
// free result from memory
mysqli_free_result($result);
// close connection
mysqli_close($conn);

?>

<h1 class="text-center mt-3">Insert Room</h1>

<div class="container bg-light mt-3 w-75">
    <form class="mt-3 " action="" method="POST">
        <label class="form-label mt-3">Name</label>
        <select class="form-select" aria-label="Default select example" name="name">
            <option value="<?php echo $name; ?>" selected><?php echo $name; ?></option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category["category_name"]; ?>"><?php echo $category["category_name"]; ?></option>
            <?php endforeach; ?>
        </select>

        <label class="form-label mt-3">Capacity</label>
        <select class="form-select" aria-label="Default select example" name="capacity">
            <option value="<?php echo $capacity; ?>" selected><?php echo $capacity; ?></option>
            <option value="2">2</option>
            <option value="4">4</option>
            <option value="6">6</option>
        </select>

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
?>