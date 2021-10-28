<?php 
  session_start();

  $admin_pages = ['dashboard'];
  $domain = "http://188.126.71.235/e-commerce/";

  if(!isset($_SESSION['is_loggedin'])) {
    $current_page = preg_replace('/\.php/i', '', explode('/', $_SERVER['PHP_SELF'])[2]);

    if(in_array($current_page, $admin_pages)) {
      header("Location: 401.php");
    }
  }

  spl_autoload_register(function ($class_name) {
      include 'classes/'.$class_name . '.php';
  });

  if(isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['is_loggedin']);
    unset($_SESSION['username']);
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-shop | Webbutv II</title>
    <meta name="author" content="Christopher State">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <style>
      .product-image {
        height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .product-image img {
        height: 120px;
      }
    </style>
</head>
<body>

<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">e-shop | Webbutv II</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ml-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= $domain ?>index.php">Start</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= $domain ?>cart.php">Varukorg (<?php if(isset($_SESSION['cart'])) echo count($_SESSION['cart']); else echo '0'; ?>)</a>
        </li>
        <li class="nav-item">
          <?php if(isset($_SESSION['is_loggedin']) && $_SESSION['is_loggedin'] == true): ?>
            <a class="nav-link" href="<?= $domain ?>admin/dashboard.php"><?= $_SESSION['username'] ?></a> 
          <?php else: ?>
            <a class="nav-link" href="login.php">Logga in</a> 
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <?php if(isset($_SESSION['is_loggedin']) && $_SESSION['is_loggedin'] == true): ?>
            <a class="nav-link" href="?action=logout">Logga ut</a> 
          <?php else: ?>
            <a class="nav-link" href="register.php">Registrera</a> 
          <?php endif; ?>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" name="search" placeholder="Sök" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Sök</button>
      </form>
    </div>
  </div>
</nav>

<div class="mt-5"></div>