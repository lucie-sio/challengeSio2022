<?php
// Sélection de l'option BTS dans l'enregistrement
define('CHOICES', [
    'SIO' => 'Services Informatiques aux Organisations',
    'ECT' => 'Economique et Commerciale',
    'AP'=> 'Arts Plastiques',
    'SAM' => 'Support à l\'Action Managériale',
    'CI'=> 'Commerce International',
    'MCO' => 'Management Commercial Opérationnel',
    'NDRC' => 'Négociation et Digitalisation de la Relation Clients',
]);

define('CLASSES', [
    0 => 'SIO',
    1 => 'ECT',
    2 => 'AP',
    3 => 'SAM',
    4 => 'CI',
    5 => 'MCO',
    6 => 'NDRC'
]);

// Couleurs d'affichage des classes de l'enseignant
define('COLORS', [
    'SIO' => 'primary',
    'ECT' => 'secondary',
    'AP'=> 'success',
    'SAM' => 'danger',
    'CI'=> 'warning',
    'MCO' => 'info',
    'NDRC' => 'dark'
]);

define('SE', [
    'Windows' => 'Windows',
    'Linux' => 'Linux',
    'Autres' => 'autres'
]);

define('SEPHONE', [
    'Android' => 'Android',
    'IOS' => 'IOS',
    'Autres' => 'Autres'
]);

define('FAI', [
    'Orange' => 'Orange',
    'Free' => 'Free',
    'SFR' => 'SFR',
    'Bouygues Telecom' => 'Bouygues Telecom',
    'Autres' => 'Autres'
]);

define('GE',[
    'Oui' => 'Oui',
    'Non' => 'Non'
]);


// AFFICHAGE DES INFO INFORMATIQUES DE L'ETUDIANT
define('DESKTOP', [
    0 => 'Adresse MAC',
    3 => 'Marque',
    4 => 'Système d\'exploitation',   
    2 => 'Mémoire vive (Go)',
    5 => 'Stockage (Go)'
]);

define('LAPTOP', [   
    0 => 'Adresse MAC',
    4 => 'Marque',
    5 => 'Système d\'exploitation',
    2 => 'Mémoire vive (Go)',
    6 => 'Stockage (Go)',
    3 => 'Fourni par le région Grand Est ?'
]);

define('TABLET', [
    0 => 'Adresse MAC',
    2 => 'Marque',
    3 => 'Système d\'exploitation',   
    4 => 'Stockage (Go)'
]);

define('SMARTPHONE', [
    0 => 'Numéro de téléphone',
    2 => 'Marque',
    3 => 'Système d\'exploitation',   
    4 => 'Stockage (Go)'
]);

define('GEARS', [
    15 => 'Casque',
    16 => 'Microphone',
    17 => 'Webcam'
]);

define('INTERNET', [
    6 => 'Opérateur mobile',
    8 => 'Fournisseur internet',
    13 => 'Débit montant (Mo)',
    14 => 'Débit descendant (Mo)'
]);



?>