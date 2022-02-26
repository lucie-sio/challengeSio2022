<?php
$erreur = null;

// verification de l'authentification et du bon rôle 
require_once 'function/auth.php';
forcer_utilisateur_connecte();
verification_param($_GET);

require_once 'function/callPDO.php';
$student = getStudent(key($_GET));
$equipment = [];

$tableau = [];
$label = [
    "Ordinateur de bureau de l'étudiant",
    "Ordinateur portable de l'étudiant",
    "Tablette de l'étudiant",
    "Smartphone de l'étudiant"
];

require_once 'data/constantes.php';
array_push($tableau,
    DESKTOP,
    LAPTOP,
    TABLET,
    SMARTPHONE,
    GEARS,
    INTERNET
);

array_push($equipment, 
    getEquipmentPDO(key($_GET), 'desktop'),
    getEquipmentPDO(key($_GET), 'laptop'),
    getEquipmentPDO(key($_GET), 'tablet'),
    getEquipmentPDO(key($_GET), 'smartphone')
);

// titre de l'onglet et ajout du header
$title = 'Fiche étudiant';
require_once 'element/header.php';
?>

<div class="container">
    <?php if(!empty($student)) :?>
    <div class="row mb-4">
    
        <div class="col-md-12">
            <h2>Fiche étudiante de <?= $student[0]['FIRSTNAME'] .' '. $student[0]['LASTNAME']?></h2>
            <br>
        </div>        

        <div class="col-md-4">
            <h4>Informations :</h4>    
            <strong>Email : </strong><?= $student[0]['EMAIL'] ?><br>
            <strong>N° INE : </strong><?= $student[0]['INE_NUMBER'] ?><br>
            <strong>Classe : </strong><span style="text-transform:uppercase"><?= $student[0]['CLASS'] ?></span><br>
        </div>

        <div class="col-md-4">
            <h4>Accessoires :</h4>
            <?php if (empty($student[0]['HEADPHONES']) && empty($student[0]['MICROPHONE']) && empty($student[0]['WEBCAM'])): ?>
                <strong>Informations insuffisantes.</strong><br>
            <?php else: ?>
                <?php foreach($tableau[4] as $index => $gears): ?>
                    <?= '<strong>'.$gears. ($student[0][$index]==='1' ? '</strong> : Oui<br>' : '</strong> : Non<br>') ?>
                
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <h4>Fournisseurs internet :</h4>
            <?php if (empty($student[0]['PHONE_PROVIDER']) && empty($student[0]['INTERNET_PROVIDER']) && empty($student[0]['UPLOAD']) && empty($student[0]['DOWNLOAD'])): ?>
                <strong>Informations insuffisantes.</strong><br>
            <?php else: ?>
                <?php foreach($tableau[5] as $index => $internet): ?>
                    <?= '<strong>'.$internet. ($student[0][$index] ? '</strong> : '.$student[0][$index].'<br>' : '</strong> : Non renseigné<br>')  ?>
                
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
        <?php if(array_filter($equipment)): ?>
        <div class="col-md-12 mt-4">
            <table class="table">
                <?php foreach ($equipment as $index => $info): ?>
                    <?php if(!empty($equipment[$index])): ?>
                        <thead colspan='2' class="thead-dark">
                            <th><?= $label[$index] ?><th>
                        <?php foreach ($tableau[$index] as $num => $info) :?>
                            <tr>
                                <td><?= $info ?></td>
                                <td><?= $equipment[$index][0][$num] ?></td>
                            </tr>                                              
                        <?php endforeach; ?>
                        </thead>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div> 
        <?php else: ?>
        <div class="col-md-12">
            <h2><?= $student[0]['FIRSTNAME'] .' '. $student[0]['LASTNAME']?> n'a saisi aucun renseignement sur son équipement.</h2>
        </div>
        <?php endif;?>  
    <?php else: ?>
        <h2>Aucun élève n'est associé au numéro INE <strong><?= key($_GET) ?></strong></h2>
        <h2><a href="./<?= $_SESSION['role'] ?>.php">Retour sur ma page</a></h2>
    <?php endif; ?> 
    
    <?php if($_SESSION['role'] === 'professor'): ?>
        <div class="col-md-12 mb-5 mt-5 text-center">
            <a href="./classe.php?<?= $student[0]['CLASS'] ?>"><button class="btn btn-info">Retour à la classe</button></a>
        </div>
    <?php endif; ?>

    <?php if($_SESSION['role'] === 'admin'): ?>
        <div class="col-md-12 mb-5 mt-5 text-center">
            <a href="./admin.php?<?= $student[0]['CLASS'] ?>"><button class="btn btn-info">Retour à la liste</button></a>
        </div>
    <?php endif; ?>

</div>

<?php require_once 'element/footer.php'; ?>