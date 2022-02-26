<?php

function est_connecte(): bool {
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['connecte']);
}

function forcer_utilisateur_connecte(): void {
    if(!est_connecte()) {
        header('Location: ./login.php');
        exit();
    }
}

function verification_role($page) {
    if ($page !== $_SESSION['role']){
        header('Location: ./'. $_SESSION['role'] .'.php');
        exit();
    }
}

function verification_param($param) {
    if (empty($param)){
        header('Location: ./index.php');
        exit();
    }
}

function redirection_role(){
    if ($_SESSION['role'] === 'student') {
        header('Location: ./student.php');
    } elseif ($_SESSION['role'] === 'professor') {
        header('Location: ./professor.php');
    } elseif ($_SESSION['role'] === 'admin') {
        header('Location: ./admin.php');
    } elseif ($_SESSION['role'] === 'grandest') {
        header('Location: ./grandest.php');
    }
    exit();
}

?>