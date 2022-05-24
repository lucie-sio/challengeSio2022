<?php 
require_once 'class/form.php';
require_once 'data/constantes.php';
$SEPHONE = SEPHONE;
$FAI = FAI;
require_once 'element/header.php';
require 'function/callPDO.php';

$erreur = null;
$valide = null;


$ine = getINEPDO($_SESSION['email']);
$pdo = getRegisterPDO();
$query = $pdo->prepare("SELECT INE_NUMBER FROM tablet WHERE INE_NUMBER = :ine");
$query->execute(array("ine"=> $ine));
$aa = $query->fetch();

if(!empty($aa)){
    if(!empty($_POST)){
        if(preg_match('/^[0123456789]+$/', $_POST['stockage'])){

            $mac = $_POST['mac'];
            $brand = $_POST['marque'];
            $os = $_POST['optionse'];
            $storage = $_POST['stockage'];

            $query1 = $pdo->query("UPDATE tablet SET MAC_ADDRESS = '$mac', BRAND= '$brand', OPERATING_SYSTEM = '$os', STORAGE = '$storage' WHERE INE_NUMBER = '$ine'");
            
            $valide = 'Vous avez bien modifié votre équipement, merci.';
        }else{
            $erreur = 'Veuillez rentrer un nombre valide.';
        }
    }
}else{
    if(!empty($_POST)){
        if(preg_match('/^[0123456789]+$/', $_POST['stockage'])){
            
            $query2 = $pdo->prepare("INSERT INTO tablet(MAC_ADDRESS, INE_NUMBER, BRAND, OPERATING_SYSTEM, STORAGE) VALUES(:mac, :ine, :brand, :os, :storage)");
            $query2->execute([
                'mac' => $_POST['mac'],
                'ine' => $ine,
                'brand' => $_POST['marque'],
                'os' => $_POST['optionse'],
                'storage' => $_POST['stockage']
            ]);
            $valide = 'Vous avez bien renseigné votre équipement, merci.';
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
    <div>
       <h1 style="text-align: center">Formulaire tablette tactile</h1>
    </div>

    <?php 
        $form = New Form();
    ?>
    <br>
    <form action="#" method="POST">
        <?php
            echo $form->input('marque', 'text', "Marque de la tablette");
            echo $form->select('optionse', $SEPHONE, "Système d'exploitation"); 
            echo $form->input('stockage', 'number', "Stockage en Go");
            echo $form->input('mac', 'text', "exemple : 00:37:6C:E2:EB:62");
            echo $form->submit('button');
        ?>
    </form>
</div>

<?php 
require_once 'element/footer.php';
?>