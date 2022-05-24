<?php 
if(session_status() === PHP_SESSION_NONE) {
	session_start();
}
// appel du fichier des fonction une première fois
// require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'function' . DIRECTORY_SEPARATOR . 'auth.php';
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="image/asci-icon.ico">

        <title>
            <?php if (isset($title)): ?>
                <?= $title ?>
            <?php else: ?>
                Mon site
            <?php endif ?>
        </title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>

    <!-- NAVBAR -->
    <nav class="navbar navbar-light mb-4" style="background-color: #17a2b8; ;font-size: 20px !important;">
        <!-- LOGO ASSO : amène à la page d'accueil -->
        <a class="navbar-brand" href=".">
            <img src="image/logo-asci-fonce.png" width="100" height="auto">
        </a>
        <!-- BOUTON DECONNEXION : amène à la page d'accueil -->
        <ul class="navbar-nav">
            <?php if (est_connecte()): ?>
            <a href="logout.php" class="nav-link"><button class="btn btn-info">Se déconnecter</button></a>
            <?php endif; ?>
        </ul>
    </nav>

    <body>
        <main role="main" class="container">
    