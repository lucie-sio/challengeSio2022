<?php 
require_once 'class/form.php';
require_once 'data/constantes.php';
$SEPHONE = SEPHONE;
$FAI = FAI;
require_once 'element/header.php';
require 'function/callPDO.php';
// initie les variables $erreur et $ valide à null
$erreur = null;
$valide = null;

// stock le numéro ine dans la variable $ine
$ine = getINEPDO($_SESSION['email']);
// On se connecte à la base de données
$pdo = getRegisterPDO();
// On regarde si un enregistrement à  déjà été effectué
$query = $pdo->prepare("SELECT INE_NUMBER FROM smartphone WHERE INE_NUMBER = :ine");
$query->execute(array("ine"=> $ine));
$aa = $query->fetch();

// Si il y a déjà eu un enregistrement alors on midifie la base de donnée
if(!empty($aa)){
    // Si il y a des données dans la variable post alors on regarde si les conditions suivantes sont validées
    if(!empty($_POST)){
        // On autorise uniquement les caractères numérique dans le input de stockage
        if(preg_match('/^[0123456789]+$/', $_POST['stockage'])){
            // On autorise uniquement les caractères numérique dans le input de stockage et on vérifie si le numéro de téléphone a bien 10 chiffres
            if(preg_match('/^[0123456789]+$/', $_POST['numerotel']) && strlen($_POST['numerotel']) === 10){
                // On stock les valeurs entrés par l'utilisateur dans des variables
                $phonenumber = $_POST['numerotel'];
                $brand = $_POST['marque'];
                $os = $_POST['optionse'];
                $storage = $_POST['stockage'];
                $optionfai = $_POST['optionfai'];
                // on créé la requête pour envoyer les informations dans la base de données
                $query1 = $pdo->query("UPDATE smartphone SET PHONE_NUMBER = '$phonenumber', BRAND= '$brand', OPERATING_SYSTEM = '$os', STORAGE = '$storage' WHERE INE_NUMBER = '$ine'");
                $query4 = $pdo->query("UPDATE student SET PHONE_PROVIDER ='$optionfai' WHERE INE_NUMBER = '$ine' ");
                $valide = 'Vous avez bien modifié votre équipement, merci.';
            }else{
                $erreur = 'Veuillez rentrer un numéro de téléphone valide.';
            }
        }else{
            $erreur = 'Veuillez rentrer un nombre valide.';
        }
    }
}else{
    // Si il y a des données dans la variable post alors on regarde si les conditions suivantes sont validées
    if(!empty($_POST)){
        // On autorise uniquement les caractères numériques dans le input de stockage
        if(preg_match('/^[0123456789]+$/', $_POST['stockage'])){
            // On autorise uniquement les caractères numérique dans le input de stockage et on vérifie si le numéro de téléphone a bien 10 chiffres
            if(preg_match('/^[0123456789]+$/', $_POST['numerotel']) && strlen($_POST['numerotel']) === 10){
                // on prépare la requête pour envoyer les informations dans la base de données
                $query2 = $pdo->prepare("INSERT INTO smartphone(PHONE_NUMBER, INE_NUMBER, BRAND, OPERATING_SYSTEM, STORAGE) VALUES(:phonenumber, :ine, :brand, :os, :storage)");
                $query2->execute([
                    'phonenumber' => $_POST['numerotel'],
                    'ine' => $ine,
                    'brand' => $_POST['marque'],
                    'os' => $_POST['optionse'],
                    'storage' => $_POST['stockage']
                ]);

                $query3 = $pdo->prepare("INSERT INTO student(PHONE_PROVIDER) VALUES(:phoneprovider)");
                $query3->execute([
                    'phoneprovider' => $_POST['optionfai']
                ]);

                $valide = 'Vous avez bien renseigné votre équipement, merci.';
            }else{
                $erreur = 'Veuillez rentrer un numéro de téléphone valide.';
            }
        }else{
            $erreur = 'Veuillez rentrer un nombre valide.';
        }
    }
}
?>
<div class="row justify-content-end">
    <div class="col-3"><a href='./student.php'><button class="btn btn-info ms-auto">Retour à ma page</button></a></div>
</div>
<div class="container border border-dark bg-light mt-3">
    <div>
       <h1 style="text-align: center">Formulaire portable</h1>
    </div>

    <?php 
        $form = New Form();
    ?>
    <br>
                <!-- Affichage de l'erreur -->
    <?php if ($erreur): ?>
        <div class="alert alert-danger text-center">
            <?= $erreur ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($valide)): ?>
        <div class="alert alert-success text-center">
            <?= $valide ?>
        </div>
    <?php endif; ?>
    <!-- Création du formulaire en POO -->
    <form action="#" method="POST">
        <?php
            echo $form->input('marque', 'text', "Marque du télépone");
            echo $form->select('optionse', $SEPHONE, "Système d'exploitation"); 
            echo $form->input('stockage', 'number', "Stockage en Go");
            echo $form->input('numerotel', 'tel', "exemple : 0601020304");
            echo $form->select('optionfai', $FAI,'Fournisseur mobile'); 
            echo $form->submit('button');
        ?>
    </form>
</div>

<?php 
require_once 'element/footer.php';
?>