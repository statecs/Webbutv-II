<?php 
    include('../../header.php'); 
    include('../../helpers/form-fields-to-session.php'); 
    include('../../helpers/validators.php'); 

    $db = new CRUD;
    $product = $db->read('products', ['id' => $_GET['id']], 1)[0];

    $errors = [];


    if(isset($_POST['update_btn'])) {
        unset($_POST['update_btn']);
        $name = $_POST['name'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $sale = $_POST['sale'];
        $description = $_POST['description'];

        $image = $_FILES['image'];
        $image_name = generateRandomName($image['name']);

        $data = [
            'name' => $name,
            'price' => $price,
            'qty' => $qty,
            'sale' => $sale,
            'description' => $description,
            'image' => $image_name 
        ];

        if(isset($image['name']) && !empty($image['name'])) {
            $data['image'] = $image_name;
        }

        if(fieldsAreNotEmpty($_POST)) {
            if($db->update('products', $data, ['id' => $_POST['id']])) {

                if(isset($image['name'])) {
                    if(isImage($image['name']) && validateSize($image['size'], 2)) {
                    move_uploaded_file($image['tmp_name'], 'images/'.$image_name);
                    }
                }
                
                header('Location: ../dashboard.php');
            } else {
                $errors[] = "Något gick fel när du försökte uppdatera produkten!";
            }
        } else {
            $errors[] = "Alla fält är obligatoriska!";
        }    

    }
?>

    <h3 class="mb-4">Uppdatera "<?= $product['name'] ?>"</h3>

    <?php if(count($errors)): ?>
    <div class="alert alert-danger mb-4" role="alert">
        <?= implode("<br />", $errors) ?>
    </div>
    <?php endif; ?>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Namn</label>
            <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="name" <?php if(!empty($product['name'])): ?> value="<?= $product['name'] ?>" <?php endif; ?>>
            </div>
        </div>
        <div class="row mb-3">
            <label for="price" class="col-sm-2 col-form-label">Pris</label>
            <div class="col-sm-10">
            <input type="text" name="price" class="form-control" id="price" <?php if(!empty($product['price'])): ?> value="<?= $product['price'] ?>" <?php endif; ?>>
            </div>
        </div>
        <div class="row mb-3">
            <label for="qty" class="col-sm-2 col-form-label">Antal</label>
            <div class="col-sm-10">
            <input type="number" name="qty" class="form-control" id="qty" <?php if(!empty($product['qty'])): ?> value="<?= $product['qty'] ?>" <?php endif; ?>>
            </div>
        </div>
        <div class="row mb-3">
            <label for="sale" class="col-sm-2 col-form-label">Rabatt</label>
            <div class="col-sm-10">
            <input type="number" name="sale" class="form-control" id="sale" <?php if(!empty($product['sale'])): ?> value="<?= $product['sale'] ?>" <?php endif; ?>>
            </div>
        </div>
        <div class="row mb-3">
            <label for="description" class="col-sm-2 col-form-label">Beskrivning</label>
            <div class="col-sm-10">
                <textarea name="description" class="form-control" id="description"><?php if(!empty($product['description'])) { echo $product['description']; } ?></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="image" class="col-sm-2 col-form-label">Bild</label>
            <div class="col-sm-10">
            <input type="file" name="image" class="form-control" id="image" />

            <?php if(!empty($product['image'])): ?>
            <img src="images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="mt-2" style="width: 120px !important" />
            <?php endif; ?>
            </div>
        </div>

        <input type="hidden" name="id" value="<?= $_GET['id'] ?>" />
        <button type="submit" name="update_btn" class="btn btn-primary">Spara</button>
    </form>




<?php include('../../footer.php'); ?>