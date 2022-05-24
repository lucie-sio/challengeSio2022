<?php 
require_once 'function/auth.php';
forcer_utilisateur_connecte();
verification_role('admin');

// récupération des données relatives à l'enseignant et ses classes
require 'function/callPDO.php';
$data = getDataPDO($_SESSION['role'], $_SESSION['email']);

// titre de l'onglet et ajout du header
$title= 'Administration du Lycée';
require 'element/header.php';
// On se connecte à la base de donnée
$pdo = getRegisterPDO();
// On prépare la requête
$query2 = $pdo->prepare("SELECT LASTNAME, FIRSTNAME, INE_NUMBER, chopin_user.EMAIL, BIRTHDAY, CLASS FROM chopin_user JOIN student ON chopin_user.EMAIL = student.EMAIL");
// On exectue la requête
$query2->execute();
// On stock la requête dans la variable $students
$students = $query2->fetchAll();
?>

<div>
    <h3>Bonjour <strong><?= $data[0]['FIRSTNAME'] ?> <?= $data[0]['LASTNAME'] ?></strong>.</h3>
</div>
 <!-- Style de la table -->
<style>
      table {
      border-collapse:collapse;
      }
      thead, tbody {
      padding: 10px;
      border-style: outset;
      border-color: #8ebf42 ;
      }
</style>

<div class="col-md-12 mt-3">
         <!-- Création de la table -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date de naissance</th>
                    <th scope="col">INE</th>
                    <th scope="col">classe</th>
                    <th scope="col">Fiche</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                     <!-- Affiche les valeurs qui se trouvent dans le tableau $student  -->
                    <td><?= $student['FIRSTNAME'] ?></td>
                    <td><?= $student['LASTNAME'] ?></td>
                    <td><?= $student['EMAIL'] ?></td>
                    <td><?= $student['BIRTHDAY'] ?></td>
                    <td><?= $student['INE_NUMBER'] ?></td>
                    <td><?= $student['CLASS'] ?></td>
                     <!-- Lien vers la fiche de l'élève en question -->
                    <td><a href="./studentCard?<?= $student['INE_NUMBER'] ?>"><button class="btn btn-info">Voir la fiche</button></a></td>
                </tr>    
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php require 'element/footer.php'; ?>