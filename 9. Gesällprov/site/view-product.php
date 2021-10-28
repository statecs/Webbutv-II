<?php 
    include('header.php'); 

    $db = new CRUD;
    $product = $db->read('products', ['id' => $_GET['id']], 1)[0];

    if(isset($_GET['action']) && isset($_GET['id'])) {
        if($_GET['action'] == 'add-to-cart') {
            if(isset($_SESSION['cart'])) {
                if(in_array($_GET['id'], array_keys($_SESSION['cart']))) {
                    $_SESSION['cart'][$_GET['id']]['qty'] = $_SESSION['cart'][$_GET['id']]['qty'] + 1;
                } else {
                    $product = $db->read('products', ['id' => $_GET['id']], 1)[0];
                    $product['qty'] = 1;

                    $_SESSION['cart'][$_GET['id']] =  $product;
                }
            } else {
                $product = $db->read('products', ['id' => $_GET['id']], 1)[0];
                $product['qty'] = 1;

                $_SESSION['cart'] = [$_GET['id'] => $product];
            }

            header("Location: " .$domain ."index.php");
        }
    }
?>


<div class="row">
    <div class="col-md-4">
        <img src="admin/products/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="img-fluid" />
    </div>
    <div class="col-md-7 offset-md-1">
        <h3><?= $product['name'] ?></h3>
        <p><?= $product['price'] ?> EUR <a href="?action=add-to-cart&id=<?= $_GET['id'] ?>">Lägg till i varukorg</a></p> 
        <p><?= $product['description'] ?></p>
    </div>
    
</div>


<?php include('footer.php'); ?>