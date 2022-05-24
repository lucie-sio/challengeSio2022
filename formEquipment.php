<?php 
require_once 'class/form.php';
require_once 'element/header.php';
require 'function/callPDO.php';

$valide = null;
// Récupération du numéro INE de l'étudiant
$ine = getINEPDO($_SESSION['email']);
// On se connecte à la base de donnée
$pdo = getRegisterPDO();
// On regarde si on a déjà en enregistrement
$query = $pdo->prepare("SELECT INE_NUMBER FROM desktop WHERE INE_NUMBER = :ine");
$query->execute(array("ine"=> $ine));
$aa = $query->fetch();

if(!empty($aa)){
    if(!empty($_POST)){
        $headphones = $_POST['casque'];
        $microphone = $_POST['micro'];
        $webcam = $_POST['webcam'];

        $query = $pdo->query("UPDATE student SET HEADPHONES ='$headphones', MICROPHONE ='$microphone', WEBCAM ='$webcam' WHERE INE_NUMBER = '$ine'");
        
        $valide = 'Vous avez bien modifié votre équipement, merci.';
    }
}else{
    if(!empty($_POST)){
        $query = $pdo->prepare("INSERT INTO student(HEADPHONES, MICROPHONE, WEBCAM) VALUES(:headphones, :microphone, :webcam)");
        $query->execute([
            'headphones' => $_POST['casque'],
            'microphone' => $_POST['micro'],
            'webcam' => $_POST['webcam']
        ]);
        $valide = 'Vous avez bien renseigné votre équipement, merci.';
    }
}
?>
<div class="row justify-content-end">
    <div class="col-3"><a href='./student.php'><button class="btn btn-info ms-auto">Retour à ma page</button></a></div>
</div>
<div class="container border border-dark bg-light mt-3">
    <div>
       <h1 style="text-align: center">Formulaire équipement</h1>
    </div>
                <!-- Affichage de l'erreur -->
    <?php if (!empty($valide)): ?>
        <div class="alert alert-success text-center">
            <?= $valide ?>
        </div>
    <?php endif; ?>
    <?php 
        $form = New Form();
    ?>
    <br>
    <form action="#" method="POST">
        <?php
            echo $form->input('casque', 'checkbox', "Avez-vous un casque ?");
            echo $form->input('micro', 'checkbox', "Avez-vous un micro ?");
            echo $form->input('webcam', 'checkbox', "Avez-vous une webcam ?");
            echo $form->submit('button');
        ?>
    </form>
</div>
<?php 
require_once 'element/footer.php';
?>