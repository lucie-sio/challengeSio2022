<?php 
// verification de l'authentification et du bon rôle 
require_once 'function/auth.php';
forcer_utilisateur_connecte();
verification_role('professor');

// récupération des constantes
require_once 'data/constantes.php';
$choices = CHOICES;
$colors = COLORS;

// récupération des données relatives à l'enseignant et ses classes
require_once 'function/callPDO.php';
$data = getDataPDO($_SESSION['role'], $_SESSION['email']);

// titre de l'onglet et ajout du header
$title= 'Ma page | Enseignant';
require 'element/header.php';

?>   

<div class="col-md-12">
    <div class="alert alert-success text-center">
        <h4>
            L'espace professeur contient chaque classe où celui-ci enseigne, puis pour chaque classe, la liste des élèves avec un accès à chaque fiche des élèves.
        </h4>
    </div>
</div>

<div class="col-md-12 text-center">
    <h3>Bonjour <strong><?= $data[0]['FIRSTNAME'] ?> <?= $data[0]['LASTNAME'] ?></strong>.</h3>
</div>
<div class="container inline-block">
    
    <div class="row justify-content-md-center mt-4">
    <div class="col-md-12 mb-4"><h4>Consultez vos classes ci-dessous :</h4></div>
    <?php foreach ($choices as $choice => $name): ?>
    <?php if ($data[0][$choice] == '1'): ?>
        <div class="col-md-4 text-center">
            <div class="card text-white bg-<?= $colors[$choice] ?> mb-3 mx-auto" style="max-width: 15rem;">
                <div class="card-header">
                    <?= $name ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= professorCountCard($choice); ?> fiche<?= (professorCountCard($choice) > 1)? 's':'' ?> disponible<?= (professorCountCard($choice) > 1)? 's':'' ?></h5>
                    <?php if(professorCountCard($choice) > 0): ?>
                        <p class="card-text"><a href="./classe.php?<?= $choice ?>"><button class="btn btn-light">Élèves de <?= $choice ?></button></a></p>
                    <?php else: ?>
                        <p class="card-text"><button class="btn btn-light" disabled>Aucune données</button></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php endforeach; ?>
    </div>
</div>
<?php require 'element/footer.php'; ?>