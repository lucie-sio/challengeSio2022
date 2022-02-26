<?php 
require_once 'class/form.php';
require_once 'data/constantes.php';
$SE = SE;
$FAI= FAI;
$choixGrandEst = GE;
require_once 'element/header.php';
require 'function/callPDO.php';

$erreur = null;
$valide = null;


$ine = getINEPDO($_SESSION['email']);
$pdo = getRegisterPDO();
$query = $pdo->prepare("SELECT INE_NUMBER FROM laptop WHERE INE_NUMBER = :ine");
$query->execute(array("ine"=> $ine));
$aa = $query->fetch();

if(!empty($aa)){
    if(!empty($_POST)){
        if(preg_match('/^[0123456789]+$/', $_POST['stockage'])){
            if(preg_match('/^[0123456789]+$/', $_POST['memoirevive'])){
            
                $mac = $_POST['mac'];
                $ram = $_POST['memoirevive'];
                $grand_est = $_POST['grand_est'];
                $brand = $_POST['marque'];
                $os = $_POST['optionse'];
                $storage = $_POST['stockage'];

                $query1 = $pdo->query("UPDATE laptop SET MAC_ADDRESS = '$mac', RAM = '$ram', GRAND_EST = '$grand_est', BRAND= '$brand', OPERATING_SYSTEM = '$os', STORAGE = '$storage' WHERE INE_NUMBER = '$ine'");
                
                $valide = 'Vous avez bien modifié votre équipement, merci.';
            }else{
                $erreur = 'Veuillez rentrer un nombre valide.';
            }
        }else{
            $erreur = 'Veuillez rentrer un nombre valide.';
        }
    }
}else{
    if(!empty($_POST)){
        if(preg_match('/^[0123456789]+$/', $_POST['stockage'])){
            if(preg_match('/^[0123456789]+$/', $_POST['memoirevive'])){
            
                $query2 = $pdo->prepare("INSERT INTO laptop(MAC_ADDRESS, INE_NUMBER, RAM, GRAND_EST, BRAND, OPERATING_SYSTEM, STORAGE) VALUES(:mac, :ine, :ram, :grand_est, :brand, :os, :storage)");
                $query2->execute([
                    'mac' => $_POST['mac'],
                    'ine' => $ine,
                    'ram' => $_POST['memoirevive'],
                    'brand' => $_POST['marque'],
                    'grand_est' => $_POST['grand_est'],
                    'os' => $_POST['optionse'],
                    'storage' => $_POST['stockage']
                ]);
                $valide = 'Vous avez bien renseigné votre équipement, merci.';
            }else{
                $erreur = 'Veuillez rentrer un nombre valide.';
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
       <h1 style="text-align: center">Formulaire ordinateur portable</h1>
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
    
    <?php
        echo $form->input('marque', 'text', "Marque de l'ordinateur");
        echo $form->select('optionse', $SE, "Système d'exploitation"); 
        echo $form->input('stockage', 'number', "Stockage en Go");
        echo $form->input('memoirevive', 'number', "Mémoire vive en Go");
        echo $form->input('mac', 'text', "exemple : 00:37:6C:E2:EB:62");
        echo $form->select('optionfai', $FAI,"Fournisseur d'accès internet");
        echo $form->select('grand_est', $choixGrandEst, "Fourni par la région grand Est ?");
        echo $form->submit('button');
    ?>
    
</div>

<?php 
require_once 'element/footer.php';
?>