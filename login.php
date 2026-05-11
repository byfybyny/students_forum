<?php
session_start();

if (isset($_SESSION['id'], $_SESSION['tipo'])) {
    header('Location: ' . ($_SESSION['tipo'] === 'scuola' ? 'homepage_scuola.php' : 'homepage_utente.php'));
    exit;
}
 
require_once "function.php";

if ($_POST['btnAction'] === 'login') {
    $id = $_POST['id'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($id === '' || $password === '') {
        $errore = 'Compila tutti i campi.';

    } else {
        $log = checkPassword($id, $password);

        if ($log !== false) {
            
            $_SESSION['id'] = $log['id'];
            $_SESSION['tipo'] = $log['tipo'];
            $_SESSION['nome'] = $log['nome'];

            header('Location: ' . ($log['tipo'] === 'scuola' ? 'homepage_scuola.php' : 'homepage_utente.php'));
            exit;

        } else {
            $errore = 'Credenziali non valide.';
        }
    }
}
?>