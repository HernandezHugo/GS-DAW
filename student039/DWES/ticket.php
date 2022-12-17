<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/header.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/connect_db.php');
include($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/db/verify_guest.php');

if (!$_SESSION['id_reserv_to_ticket']) {
    header('Location: /student039/dwes/');
}

//success msgs 
$msg = $_GET['msg'] ?? null;
$ticket = [];

$my_reservation = $_SESSION['id_reserv_to_ticket'];

unset($_SESSION['id_reserv_to_ticket']);

$sql = "CALL 039_ticket($my_reservation)";
if (mysqli_query($conn, $sql)) {
    
    $sql = "SELECT * FROM 039_cart WHERE ID_reservation = $my_reservation";
    $result = mysqli_query($conn, $sql);
    $ticket = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
}

$total_price = 0;

?>

<h1 class="text-center mt-3">Ticket</h1>

<div class="container my-5">

    <?php if ($msg == 1) : ?>
        <p class="text-center text-white fw-bold mt-1  bg-success">
            <?php echo 'Check-out succeeded'; ?>
        </p>
    <?php endif; ?>

    <?php if ($ticket) : ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"># Reservation</th>
                    <th scope="col"># Service</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ticket as $product) : ?>
                    <tr>
                        <?php
                        $total_price += floatval($product['total']);
                        foreach ($product as $product_data) : ?>
                            <td>
                                <?php echo $product_data; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td>TOTAL PRICE:</td>
                    <td><?php echo $total_price; ?> €</td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/student039/dwes/templates/footer.php');
?>