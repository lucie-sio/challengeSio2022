<?php

// initiation de PDO en fonction de l'utilisateur qui accède aux données de la base de données
function callPDO(string $role, string $password){
    $dsn = 'mysql:host=localhost;dbname=challenge_parc_info' ;
    try {
        return new PDO($dsn, $role, $password);
    } catch(PDOException $e) { 
        return strval($e); 
    }
}

// récupération des données pour valider l
function getLoginPDO(){
    $pdo = callPDO('login', 'qBmNBCrkLb0ZZbSM');
    return $pdo;
}

// envoi des données pour l'inscription d'un étudiant
function getRegisterPDO(){
    $pdo = callPDO('student', 'msrSvTrRnJQiLzN8');
    return $pdo;
}

// récupération du numéro INE de l'étudiant qui rempli un formulaire, l'ine est la clé primaire des tables des équipements info
function getINEPDO(string $email){
    $pdo = callPDO('student', 'msrSvTrRnJQiLzN8');

    $query = $pdo->prepare('SELECT INE_NUMBER FROM student WHERE student.EMAIL = :email');
    $query->execute(array('email' => $email));

    return $query->fetchColumn();
}

function getDataPDO(string $role, string $email){
    // stockage des utilisateurs possibles
    $users = [
        'professor' => 'ur1SB32TLKtNrxY0',
        'student' => 'msrSvTrRnJQiLzN8',
        'admin' => 'PbVCSLSHFFDVuNIE',
        'grandest' => '7r2pPvYDSWn5rkJe'
    ];

    // connexion à la base de données selon le rôle
    $pdo = callPDO($role, $users[$role]);
    if($role === 'professor' || $role === 'student') {

        // stockage de la requete de récupération des logins de l'utilisateur selon son l'email rentré
        $query = $pdo->prepare('SELECT * FROM chopin_user, '.$role.' WHERE chopin_user.EMAIL = :email AND '.$role.'.EMAIL = :email');
        $query->execute(array('email' => $email));
    } elseif($role === 'admin' || $role === 'grandest'){

        // stockage de la requete de récupération des logins de l'utilisateur selon son l'email rentré
        $query = $pdo->prepare('SELECT * FROM chopin_user WHERE chopin_user.EMAIL = :email');
        $query->execute(array('email' => $email));
    }

    // envoi des données récupérées
    return $query->fetchAll();
}

function getEquipmentPDO(string $ine, $table){
    // connexion à la base de données selon le rôle
    $pdo = callPDO('student', 'msrSvTrRnJQiLzN8');
    // récupération des données pour afficher à l'étudiant

    // stockage de la requete de récupération selon l'utilisateur
    $query = $pdo->prepare('SELECT * FROM '. $table .' WHERE '.$table.'.INE_NUMBER = :ine');
    $query->execute(array('ine' => $ine));

    // renvoi des données
    return $query->fetchAll();
}

// compte le nombre d'élèves qui ont un compte (donc une fiche)
function professorCountCard($classe){
    $pdo = callPDO('professor', 'ur1SB32TLKtNrxY0');

    $query = $pdo->prepare("SELECT count(chopin_user.EMAIL) FROM chopin_user JOIN student ON chopin_user.EMAIL = student.EMAIL WHERE CLASS=:class");
    $query->execute(array('class' => $classe));
    $number = $query->fetchAll();   

    return $number[0][0];
}

// renvoi les infos de chaque élève de la classe demandées
function getClass(string $classe){
    $pdo = callPDO('professor', 'ur1SB32TLKtNrxY0');

    $query = $pdo->prepare("SELECT FIRSTNAME, LASTNAME, chopin_user.EMAIL, student.INE_NUMBER FROM chopin_user JOIN student ON chopin_user.EMAIL = student.EMAIL WHERE CLASS=:class");
    $query->execute(array('class' => $classe));

    return $query->fetchAll();  
}

// renvoi les information de l'élève selon son numéro INE
function getStudent(string $ine){
    $pdo = callPDO('professor', 'ur1SB32TLKtNrxY0');

    $query = $pdo->prepare("SELECT * FROM chopin_user JOIN student ON chopin_user.EMAIL = student.EMAIL WHERE student.INE_NUMBER = :ine");
    $query->execute(array('ine' => $ine));

    return $query->fetchAll();  
}

// première requête utile au GrandEst
function grandestQuery1(){
    $pdo = callPDO('grandest', '7r2pPvYDSWn5rkJe');

    // Combien d'élèves ont un ordinateur GrandEst ?
    $query = $pdo->prepare("
        SELECT chopin_user.FIRSTNAME, chopin_user.LASTNAME, chopin_user.EMAIL 
        FROM chopin_user 
        JOIN student ON chopin_user.EMAIL = student.EMAIL 
        JOIN laptop ON student.INE_NUMBER = laptop.INE_NUMBER 
        WHERE laptop.GRAND_EST = 'Oui'");
    $query->execute();

    return $query->fetchAll();
}

// deuxième requête utile au GrandEst
function grandestQuery2(){
    $pdo = callPDO('grandest', '7r2pPvYDSWn5rkJe');

    // Combien d'élèves n'ont pas d'ordinateur portable ?
    $query = $pdo->prepare("
        SELECT chopin_user.FIRSTNAME, chopin_user.LASTNAME, chopin_user.EMAIL 
        FROM chopin_user 
        JOIN student ON chopin_user.EMAIL = student.EMAIL 
        LEFT JOIN laptop ON student.INE_NUMBER = laptop.INE_NUMBER 
        LEFT JOIN desktop ON student.INE_NUMBER = desktop.INE_NUMBER 
        WHERE (laptop.INE_NUMBER IS NULL) OR (desktop.INE_NUMBER IS NULL)
    ");
    $query->execute();

    return $query->fetchAll();
}

?>