<?php 
    include('header.php'); 

    if(isset($_GET['action']) && isset($_GET['id'])) {
        if($_GET['action'] == 'delete') {
            unset($_SESSION['cart'][$_GET['id']]);
            header("Location: " .$domain ."cart.php");
        }
    }
?>

    <h3 class="mb-4">Varukorg</h3>

    <?php if(count($_SESSION['cart'])) { ?>
        <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Titel</th>
            <th>Antal</th>
            <th>Pris</th>
            <th>Rabatt</th>
            <th>Delsumma</th>
            <th></th>
        </tr>
        <?php 
        $total = 0.0;
        foreach($_SESSION['cart'] as $product) { 
        ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['qty'] ?></td>
            <td><?= number_format($product['price'], 2, ".", "") ?></td>
            <td><?= $product['sale'] ?>%</td>
            <td>
                <?php 
                    $subtotal = $product['qty'] * $product['price'];
                    if($product['sale'] > 0) {
                        $subtotal = $subtotal * (1.0 - ($product['sale'] / 100));
                    } 
                    
                    $total += $subtotal;
                    echo number_format($subtotal, 2, ".", "");
                ?>
            </td>
            <td>
                <a href="?action=delete&id=<?= $product['id'] ?>" 
                   class="btn btn-sm btn-danger" 
                   onclick="return confirm('Are you sure?')"
                >
                    Ta bort
                </a>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="5"></td>
            <td><?= number_format($total, 2, ".", "") ?> EUR</td>
            <td></td>
        </tr>
        </table>
    <?php } else { ?>
        <p>0 Produkter</p>
    <?php } ?>


<?php include('footer.php'); ?>