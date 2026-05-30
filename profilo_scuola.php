<?php
    session_start(); 

    require_once "function.php";

    global $pdo;

    $id_scuola = $_GET['scuola_id'] ?? '';

    if($id_scuola === '') {
        header("Location: logout.php");
    }

    $stmt = $pdo->prepare("SELECT * FROM scuole WHERE scuola_id = ?");
    $stmt->execute([$id_scuola]);
    $scuola = $stmt->fetch();  

    print_r($scuola);