<?php 
    include('../header.php'); 

    $db = new CRUD;
    $products = $db->read('products');

    if(isset($_GET['action']) && isset($_GET['id'])) {
        if($_GET['action'] == 'delete') {
            $db->delete('products', ['id' => $_GET['id']]);
            header("Location: ".$domain."admin/dashboard.php");
        }
    }

    if(!isset($_SESSION['is_loggedin']) && !$_SESSION['is_loggedin'] == true) { 
        header("Location: ".$domain."/index.php");
    }
        
    ?>

    <h3 class="mb-4">Dashboard</h3>

    <a href="products/create.php" class="btn btn-sm btn-primary mb-2">Lägg till ny produkt</a>
    <?php if(count($products)) { ?>
        <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Titel</th>
            <th>Pris</th>
            <th>Antal</th>
            <th>Rabatt</th>
            <th></th>
        </tr>
        <?php foreach($products as $product) { ?>
        <tr>
            <th><?= $product['id'] ?></th>
            <th><?= $product['name'] ?></th>
            <th><?= $product['price'] ?></th>
            <th><?= $product['qty'] ?></th>
            <th><?= $product['sale'] ?>%</th>
            <th>
                <a href="?action=delete&id=<?= $product['id'] ?>" 
                   class="btn btn-sm btn-danger" 
                   onclick="return confirm('Are you sure?')"
                >
                    Ta bort
                </a>
                <a href="products/edit.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-primary">
                    Ändra
                </a>
            </th>
        </tr>
        <?php } ?>
        </table>
    <?php } else { ?>
        <p>0 Produkter</p>
    <?php } ?>


<?php include('../footer.php'); ?>