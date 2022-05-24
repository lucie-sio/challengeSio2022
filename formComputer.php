<?php 
require_once 'class/form.php';
require_once 'data/constantes.php';
$SE = SE;
$FAI= FAI;
require_once 'element/header.php';
require 'function/callPDO.php';

$erreur = null;
$valide = null;

$ine = getINEPDO($_SESSION['email']);
$pdo = getRegisterPDO();
$query = $pdo->prepare("SELECT INE_NUMBER FROM desktop WHERE INE_NUMBER = :ine");
$query->execute(array("ine"=> $ine));
$aa = $query->fetch();

if(!empty($aa)){
    if(!empty($_POST)){
        if(preg_match('/^[0123456789]+$/', $_POST['stockage'])){
            if(preg_match('/^[0123456789]+$/', $_POST['memoirevive'])){
            
                $mac = $_POST['mac'];
                $ram = $_POST['memoirevive'];
                $brand = $_POST['marque'];
                $os = $_POST['optionse'];
                $storage = $_POST['stockage'];
                $optionfai = $_POST['optionfai'];

                $query1 = $pdo->query("UPDATE desktop SET MAC_ADDRESS = '$mac', RAM = '$ram', BRAND= '$brand', OPERATING_SYSTEM = '$os', STORAGE = '$storage' WHERE INE_NUMBER = '$ine'");
                $query2 = $pdo->query("UPDATE student SET INTERNET_PROVIDER ='$optionfai' WHERE INE_NUMBER = '$ine'");
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
            
                $query1 = $pdo->prepare("INSERT INTO desktop(MAC_ADDRESS, INE_NUMBER, RAM, BRAND, OPERATING_SYSTEM, STORAGE) VALUES(:mac, :ine, :ram, :brand, :os, :storage)");
                $query1->execute([
                    'mac' => $_POST['mac'],
                    'ine' => $ine,
                    'ram' => $_POST['memoirevive'],
                    'brand' => $_POST['marque'],
                    'os' => $_POST['optionse'],
                    'storage' => $_POST['stockage']
                ]);

                $query2 = $pdo->prepare("INSERT INTO student(INTERNET_PROVIDER) VALUES(:internetprovider)");
                $query2->execute([
                    'internetprovider' => $_POST['optionfai']
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
       <h1 style="text-align: center">Formulaire ordinateur fixe</h1>
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
    <form action="#" method="POST">
        <?php
            echo $form->input('marque', 'text', "Marque de l'ordinateur");
            echo $form->select('optionse', $SE, "Système d'exploitation");
            echo $form->input('stockage', 'number', "Stockage en Go");
            echo $form->input('memoirevive', 'number', "mémoire vive en Go");
            echo $form->input('mac', 'text', "exemple : 00:37:6C:E2:EB:62");
            echo $form->select('optionfai', $FAI, "Fournisseur d'accès internet"); 
            echo $form->submit('button');
        ?>
    </form>
</div>

<?php 
require_once 'element/footer.php';
?>
