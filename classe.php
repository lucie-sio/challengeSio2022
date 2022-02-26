<?php
$erreur = null;

// verification de l'authentification et du bon rôle 
require_once 'function/auth.php';
forcer_utilisateur_connecte();
verification_role('professor');
verification_param($_GET);

// récuperation des infos de l'élèves selon son n°INE
require_once 'function/callPDO.php';
$students = getClass(key($_GET));

// titre de l'onglet et ajout du header
$title = 'Classe';
require_once 'element/header.php';
?>

<div class="container">
<?php if (!empty($students)): ?>
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Classe de <strong><?= key($_GET) ?></strong></h3>
            <h5>Vous pouvez consulter la fiche individuelle de chaque étudiant répertoriant son matériel informatique.</h5>
        </div>
        
    </div>
    <div class="col-md-12">
        <!-- Affichage du tableau des élèves -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Fiche</th>
                </tr>
            </thead>
            <tbody>
                <!-- Pour chaque élève, on ajoute une ligne dans le tableau avec les infos utiles -->
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= $student['FIRSTNAME'] ?></td>
                    <td><?= $student['LASTNAME'] ?></td>
                    <td><?= $student['EMAIL'] ?></td>
                    <td><a href="./studentCard.php?<?= $student['INE_NUMBER'] ?>"><button class="btn btn-info">Voir la fiche</button></a></td>
                </tr>    
            <?php endforeach; ?>
            </tbody>
            
        </table>
       

        
    </div>

<?php else: ?> 
    <!-- Si l'utilisateur essaye d'accéder à une fiche élève avec un n°INE au hasard -->
    <h2>La <?= key($_GET) ?> classe n'a pas d'élèves enregistrés ou n'existe pas !</h2>
<?php endif; ?> 

<div class="col-md-12 mb-5 mt-5 text-center">
    <!-- bouton de retour à la page professeur -->
    <h2><a href="./professor.php"><button class="btn btn-info">Retour à l'espace professeur</button></a></h2>
</div>


</div>


<?php require_once 'element/footer.php'; ?>