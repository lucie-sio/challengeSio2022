<?php 
// verification de l'authentification et du bon rôle 
require_once 'function/auth.php';
forcer_utilisateur_connecte();
verification_role('student');

// initialisation des variables
$equipment = [];
$tableau = [];
$label = [
    'Votre ordinateur de bureau',
    'Votre ordinateur portable',
    'Votre tablette',
    'Votre smartphone'
];

// récupération des données personnelles de l'étudiant et son équipement
require_once 'function/callPDO.php';
$data = getDataPDO($_SESSION['role'], $_SESSION['email']);
array_push($equipment, 
    getEquipmentPDO($data[0]['INE_NUMBER'], 'desktop'),
    getEquipmentPDO($data[0]['INE_NUMBER'], 'laptop'),
    getEquipmentPDO($data[0]['INE_NUMBER'], 'tablet'),
    getEquipmentPDO($data[0]['INE_NUMBER'], 'smartphone')
);

require_once 'data/constantes.php';
array_push($tableau,
    DESKTOP,
    LAPTOP,
    TABLET,
    SMARTPHONE,
    GEARS,
    INTERNET
);

$table = [
    'Votre ordinateur de bureau',
    'Votre ordinateur portable',
    'Votre tablette',
    'Votre Smartphone',
    'Vos Accessoires'
];

// titre de l'onglet et ajout du header
$title= 'Ma page | Étudiant';
require 'element/header.php';
?>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="alert alert-success text-center">
            <h4>Pour simplifier la visite, les formulaires d'ajout d'un équipement ont été désactivés, vous pouvez seulement les visualiser.</h4>
            <h4>L'espace étudiant leur permet de renseigner leur équipement informatique et leurs informations personnelles. </h4>
        </div>
    </div>

    <div class="col-md-12 text-center">
        <h3>Bonjour <strong><?= $data[0]['FIRSTNAME'] ?> <?= $data[0]['LASTNAME'] ?></strong>.</h3><br>
    </div>
    <div class="col-md-5">
        <h3>Mes informations personnelles : </h3>
        <strong>Email : </strong><?= $data[0]['EMAIL'] ?><br>
        <strong>N° INE : </strong><?= $data[0]['INE_NUMBER'] ?><br>
        <strong>Classe : </strong><span style="text-transform:uppercase"><?= $data[0]['CLASS'] ?></span><br>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-4">
        <h4>Mes accessoires :</h4>
        <?php if (empty($data[0]['HEADPHONES']) && empty($data[0]['MICROPHONE']) && empty($data[0]['WEBCAM'])): ?>
            <strong>Informations insuffisantes.</strong><br>
            <a href="./formEquipment.php">Renseignez vos accessoires</a>
        <?php else: ?>
            <?php foreach($tableau[4] as $index => $gears): ?>
                <?= '<strong>'.$gears. ($data[0][$index]==='1' ? '</strong> : Oui<br>' : '</strong> : Non<br>') ?>
            
            <?php endforeach; ?>
        <?php endif; ?>
        <br>
        <h4>Fournisseurs internet :</h4>
        <?php if (!empty($data[0]['PHONE_PROVIDER']) && empty(!$data[0]['INTERNET_PROVIDER']) && empty(!$data[0]['UPLOAD']) && empty(!$data[0]['DOWNLOAD'])): ?>
            <strong>Informations insuffisantes.</strong><br>
        <?php else: ?>
            <?php foreach($tableau[5] as $index => $internet): ?>
                <?= '<strong>'.$internet. ($data[0][$index] ? '</strong> : '.$data[0][$index].'<br>' : '</strong> : Non renseigné<br>')  ?>
            
            <?php endforeach; ?>
        <?php endif; ?>
    </div>   
    <div class="col-md-12 mt-5">
        <h4 class="text-center">Ajoutez ou modifiez vos informations sur vos équipements</h4>
    </div>   
</div>
<div class="row mt-3">
    <div class="col-md-1"></div>

        <!-- ICONE ORDINATEUR DE BUREAU -->
        <?php if(empty($equipment[0])): ?>
        <div class="col-md-2"><a href="formComputer.php"><img class="img-fluid" src="./image/desktop-add.png" alt=""></a></div>
        <?php else: ?>
        <div class="col-md-2"><a href="formComputer.php"><img class="img-fluid" src="./image/desktop-modify.png" alt=""></a></div>
        <?php endif; ?>

        <!-- ICONE ORDINATEUR PORTABLE -->
        <?php if(empty($equipment[1])): ?>
        <div class="col-md-2"><a href="formPC.php"><img class="img-fluid" src="./image/laptop-add.png" alt=""></a></div>
        <?php else: ?>
        <div class="col-md-2"><a href="formPC.php"><img class="img-fluid" src="./image/laptop-modify.png" alt=""></a></div>
        <?php endif; ?>
        
        <!-- ICONE TABLETTE -->
        <?php if(empty($equipment[2])): ?>
        <div class="col-md-2"><a href="formTablet.php"><img class="img-fluid" src="./image/tablet-add.png" alt=""></a></div>
        <?php else: ?>
        <div class="col-md-2"><a href="formTablet.php"><img class="img-fluid" src="./image/tablet-modify.png" alt=""></a></div>
        <?php endif; ?>

        <!-- ICONE TELEPHONE PORTABLE -->
        <?php if(empty($equipment[3])): ?>
        <div class="col-md-2"><a href="formPhone.php"><img class="img-fluid" src="./image/phone-add.png" alt=""></a></div>
        <?php else: ?>
        <div class="col-md-2"><a href="formPhone.php"><img class="img-fluid" src="./image/phone-modify.png" alt=""></a></div>
        <?php endif; ?>

        <!-- ICONE EQUIPEMENT casque, micro, webcam -->
        <?php if(empty($data[0]['HEADPHONES'] && empty($data[0]['MICROPHONE']) && empty($data[0]['WEBCAM']))): ?>
        <div class="col-md-2"><a href="formEquipment.php"><img class="img-fluid" src="./image/gear-add.png" alt=""></a></div>
        <?php else: ?>
        <div class="col-md-2"><a href="formEquipment.php"><img class="img-fluid" src="./image/gear-modify.png" alt=""></a></div>
        <?php endif; ?>
    <div class="col-md-1"></div>
</div>
<div class="row mt-5">
    <h3>Récapitulatif</h3>
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
</div>
<div class="row mt-5 mb-5">
    <div class="col-md-5"><strong>Création du profil :</strong> <?= date('\L\e d/m/Y à H:i:s', strtotime($data[0][11]));  ?></div>
    <div class="col-md-2"></div>
    <div class="col-md-5"><strong>Dernière modification :</strong> <?= date('\L\e d/m/Y à H:i:s', strtotime($data[0][12]));  ?></div>
</div>


<?php require 'element/footer.php'; ?>
