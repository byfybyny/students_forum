<?php

require_once 'function.php';

session_start();

// dati dell'utente
$utente_id = $_SESSION['utente_id'] ?? null;
$scuola_id = $_SESSION['scuola_id'] ?? null;

if($utente_id === null && $scuola_id === null){
    header('Location: login.php');
    exit;
}

// dati della richiesta
$forum_id = $_REQUEST['forum_id'] ?? null;
$commento_id = $_REQUEST['commento_id'] ?? null;

if($commento_id === null || $forum_id === null){
    die('Commento non valido');
}

$is_eliminato = false;
if($scuola_id !== null){
    $is_eliminato = deleteCommento($commento_id, $scuola_id, 'scuola');
}
else{
    $is_eliminato = deleteCommento($commento_id, $utente_id, 'utente');
}

$risultato = $is_eliminato ? 'true' : 'false';
header("Location: forum.php?forum_id=$forum_id&eliminato=$risultato");