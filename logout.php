<?php
session_start();
unset($_SESSION['connecte']);
unset($_SESSION['email']);
unset($_SESSION['role']);
header('Location: ./');
?>