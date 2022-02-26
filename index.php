<?php 

// titre de l'onglet et ajout du header
$title= 'Accueil';
require 'element/header.php';
?>


<div class="container">
    <div class="row mt-3">
        <div class="col-12 text-left list-inline">
            <!-- Message de bienvenue -->
            <h2>Bienvenue sur la gestion du <strong>Parc Informatique</strong> du lycée Frédéric Chopin</h2>

            <!-- Description du site -->
            <p>
                Cet espace est destiné aux étudiants du Lycée Frédéric Chopin qui souhaitent renseigner l'ensemble de leur équipement informatique :
                    <ul class="">
                        <li>Ordinateurs fixes, portables et tablettes</li>
                        <li>Téléphone</li>
                        <li>Accessoires : casque, microphone...</li>
                    </ul>
                La collecte de ces données a pour but d'être visualisé par vos professeurs et par l'équipe d'administration du lycée afin d'adapter leurs moyens et leurs méthodes de communication. 
            </p>
        </div>
        
        <?php if (!est_connecte()): ?>
        <!-- Bouton de connexion -->
        <div class="col-12 text-center">
            <a href="./login.php"><button class="btn btn-lg btn-info mt-3 mb-3">Se connecter</button></a>
        </div>
        <?php endif; ?>

        <?php if (est_connecte()): ?>
        <!-- Bouton de connexion -->
        <div class="col-12 text-center">
            <a href="./login.php"><button class="btn btn-lg btn-info mt-3 mb-3">Mon espace</button></a>
        </div>
        <?php endif; ?>



        <!-- Image -->
        <div class="col-12 text-center">
            <img src="image/image-accueil.png" class="img-fluid" width="400" height="auto">
        </div>
    </div>
</div>

<?php require 'element/footer.php'; ?>