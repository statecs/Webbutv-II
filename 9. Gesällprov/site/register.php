<?php 
    include('header.php'); 
    
    if(isset($_SESSION['is_loggedin'])) {
        header("Location: dashboard.php");
    }
    
    $errors = [];

    if(isset($_POST['register_btn'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $_SESSION['username'] = $username;
        
        if(!empty($username) && !empty($password)) {
            if($_POST['password'] == $_POST['confirm_password']) {
                $db = new CRUD;
                if($db->create('users', ['username' => $username, 'password' => $password]))
                    header('Location: '.$domain.'login.php?action=register&status=1');
                else 
                    $errors[] = "Något gick fel när du registrerade användaren!";
            } else {
                $errors[] = "Lösenordet stämmer inte överens!";
            }
        } else {
            $errors[] = "Vänligen fyll i alla fält!";
        }
    }
?>

    <?php if(count($errors)): ?>
    <div class="alert alert-danger" role="alert">
        <?= implode("<br />", $errors) ?>
    </div>
    <?php endif; ?>


    <h4>Register</h4>
    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" class="mt-4">
        <div class="row mb-3">
            <label for="username" class="col-sm-2 col-form-label">Användarnamn</label>
            <div class="col-sm-10">
            <input type="text" name="username" class="form-control" id="username" <?php if(isset($_SESSION['username'])): ?> value="<?= $_SESSION['username'] ?>" <?php endif; ?>>
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-sm-2 col-form-label">Lösenord</label>
            <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="password">
            </div>
        </div>
        <div class="row mb-3">
            <label for="confirm-password" class="col-sm-2 col-form-label">Bekräfta lösenord</label>
            <div class="col-sm-10">
            <input type="password" name="confirm_password" class="form-control" id="confirm-password">
            </div>
        </div>
        <button type="submit" name="register_btn" class="btn btn-primary">Registrera</button>
    </form>
    

<?php include('footer.php'); ?>