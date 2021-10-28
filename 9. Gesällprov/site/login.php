<?php 
    include('header.php'); 
    
    if(isset($_SESSION['is_loggedin'])) {
        header("Location: dashboard.php");
    }
    
    $errors = [];

    if(isset($_POST['login_btn'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($password)) {
            $db = new CRUD;
            $results = $db->read('users', ['username' => $username]);
            foreach($results as $user) {
                if(password_verify($password, $user['password'])) {
                    $_SESSION['is_loggedin'] = true;
                    $_SESSION['username'] = $username;
                    header("Location: ".$domain."admin/dashboard.php");
                }
            }

            $errors[] = "Användarnamnet eller/och lösenordet är felaktigt!";
        } else {
            $errors[] = "Vänligen fyll i alla fält!";
        }
    }
?>

    <?php 
        if(isset($_GET['action']) && isset($_GET['status'])) {
            if($_GET['action'] == 'register' && $_GET['status'] == 1) {
                echo "Du har blivit registrerad :)";
                echo "<br />";
                echo "Vänligen logga in:";

                $username = $_SESSION['username'];
            }
        }
    ?>
    
    <?php if(count($errors)): ?>
    <div class="alert alert-danger" role="alert">
        <?= implode("<br />", $errors) ?>
    </div>
    <?php endif; ?>

    <h4>Login</h4>
    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" class="mt-4">
    <div class="row mb-3">
        <label for="username" class="col-sm-2 col-form-label">Användarnamn</label>
        <div class="col-sm-10">
        <input type="text" name="username" class="form-control" id="username" <?php if(!empty($username)): ?> value="<?= $username ?>" <?php endif; ?>>
        </div>
    </div>
    <div class="row mb-3">
        <label for="password" class="col-sm-2 col-form-label">Lösenord</label>
        <div class="col-sm-10">
        <input type="password" name="password" class="form-control" id="password">
        </div>
    </div>
    <button type="submit" name="login_btn" class="btn btn-primary">Logga in</button>
    </form>
    


<?php include('footer.php'); ?>