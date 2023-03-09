<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_booking_select.php');
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/db_booking_insert.php');

?>
<main class="container">
    <div class="row">
        <div class="col">
            <form action="booking.php" class="text-center bg-light my-5 px-2" method="POST">
                <div class="mb-3">
                    <label class="p-2 m-2" class="form-label mt-3">Initial date</label>
                    <input class="p-2 m-2" type="date" name="initial_date" value="<?php echo $initial_date; ?>">
                    <label class="p-2 m-2" class="form-label mt-3">Final date</label>
                    <input class="p-2 m-2" type="date" name="final_date" value="<?php echo $final_date; ?>">
                    <input class="p-2 m-2 btn btn-outline-primary" type="submit" name="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <?php foreach ($available_categories as $category) : ?>
            <div class="card m-5" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4 d-flex align-items-center">
                        <img src="<?php echo './img/' . $category['category_name'] . '.jpg'; ?>" class="img-fluid rounded-start" style="width: 100%;" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $category['category_name']; ?></h5>
                            <p class="card-text"><?php echo $category['category_description']; ?>...</p>
                            <p class="card-text"><i class="bi bi-person-fill"></i> <?php echo $category['capacity']; ?> - <?php echo $category['price']; ?> €</p>
                            <form action="booking.php" method="post">
                                <input type="hidden" name="book_id_category" value="<?php echo $category['ID_category']; ?>">
                                <input type="hidden" name="book_initial_date" value="<?php echo $initial_date; ?>">
                                <input type="hidden" name="book_final_date" value="<?php echo $final_date; ?>">
                                <input type="hidden" name="book_capacity" value="<?php echo $category['capacity']; ?>">
                                <input type="hidden" name="book_price" value="<?php echo $category['price']; ?>">
                                <input type="submit" name="book" class="btn btn-outline-success" value="Book">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>


<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/footer.php');
?>

</body>

</html>