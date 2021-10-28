<?php 
    include('header.php'); 

    $db = new CRUD;

    if(isset($_GET['search'])) {
        $products = $db->read('products', ['name' => $_GET['search']]);        
    } else {
        $products = $db->read('products');
    }

    if(isset($_GET['action']) && isset($_GET['id'])) {
        if($_GET['action'] == 'delete') {
            $db->delete('products', ['id' => $_GET['id']]);
            header("Location: dashboard.php");
        }
    }

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

 <div class="">
    <?php if(count($products)) { ?>
        <div class="row">
        <?php foreach($products as $product) { ?>
            <div class="col-md-3">
                <div class="card m-2">
                    <div class="card-body">
                    <a class="text-reset text-decoration-none" href="view-product.php?id=<?= $product['id'] ?>">
                        <div class="product-image">
                            <img src="admin/products/images/<?= $product['image'] ?>"   alt="<?= $product['name'] ?>" class="mt-2 product-image" />
                        </div>
                         <h3><?= $product['name'] ?></h3>
                         <p><?= substr($product['description'], 0, 50)  ?>...</p>
                        </div>
                    </a>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="?action=add-to-cart&id=<?= $product['id'] ?>">Lägg till i varukorg</a>
                        <a href="view-product.php?id=<?= $product['id'] ?>">Visa detaljer</a>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    <?php } else { ?>
        <p>0 Produkter</p>
    <?php } ?>
</div>



<?php include('footer.php'); ?>