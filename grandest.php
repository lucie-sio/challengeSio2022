<?php 
// verification de l'authentification et du bon rôle 
require_once 'function/auth.php';
forcer_utilisateur_connecte();
verification_role('grandest');


// récupération des données relatives à l'enseignant et ses classes
require_once 'function/callPDO.php';
$data = getDataPDO($_SESSION['role'], $_SESSION['email']);
$grandeststat1 = grandestQuery1();
$grandeststat2 = grandestQuery2();
$tableau = [
    'Nom',
    'Prénom',
    'Adresse mail'
];

// titre de l'onglet et ajout du header
$title= 'Ma page | GrandEst';
require 'element/header.php';
?>   

<div class="col-md-12">
    <div class="alert alert-success text-center">
        <h4>
            Cet espace est destiné à un employé de la région Grand-Est qui chercherait à se renseigner sur le nombre d'étudiants 
            utilisant un ordinateur portable fournit par la région, ou le nombre potentiel d'étudiants qui ont besoin d'un ordinateur.
        </h4>
    </div>
</div>

<div class="col-md-12 text-center">
    <h3>Bonjour <strong><?= $data[0]['FIRSTNAME'] ?> <?= $data[0]['LASTNAME'] ?></strong>.</h3>
</div>
<div class="container inline-block">
    <div class="row">
    <?php if (!empty($grandeststat1)):?>
        <div class="col-md-12 mt-4">    
            <h3>Étudiants qui possèdent un ordinateur portable fournit par la région GrandEst</h3>
            
                <table class="table">
                    <thead>
                        <tr>
                            <th scrope="col">Nom</th>
                            <th scrope="col">Prénom</th>
                            <th scrope="col">Adresse mail</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($grandeststat1 as $student): ?>
                        <tr>
                            <td><?= $student['LASTNAME'] ?></td>
                            <td><?= $student['FIRSTNAME'] ?></td>
                            <td><?= $student['EMAIL'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            
        </div>
    <?php endif; ?>
    
    <?php if (!empty($grandeststat2)):?>
        <div class="col-md-12 mt-4">
            <h3>Étudiants qui ne possèdent aucun ordinateur (fixe ou portable)</h3>
        </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scrope="col">Nom</th>
                        <th scrope="col">Prénom</th>
                        <th scrope="col">Adresse mail</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($grandeststat2 as $student): ?>
                    <tr>
                        <td><?= $student['LASTNAME'] ?></td>
                        <td><?= $student['FIRSTNAME'] ?></td>
                        <td><?= $student['EMAIL'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
    <?php endif; ?>
    </div>
</div>
<?php require 'element/footer.php'; ?>