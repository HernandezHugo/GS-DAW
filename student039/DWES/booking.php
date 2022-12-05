<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/header.php');

?>
<main class="container">
    <div class="row">
        <div class="col">
            <form class="text-center bg-light my-5 px-2" action="" method="POST">
                <div class="mb-3">
                    <label class="p-2 m-2" class="form-label mt-3">Initial date</label>
                    <input class="p-2 m-2" type="date" name="initial_date">
                    <label class="p-2 m-2" class="form-label mt-3">Final date</label>
                    <input class="p-2 m-2" type="date" name="final_date">
                    <input class="p-2 m-2 btn btn-outline-primary btn-sm" type="submit" name="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
</main>


<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/footer.php');
?>