<?php

require_once "function.php";

session_start();

// dati dell'utente
$utente_id = $_SESSION['utente_id'] ?? null;
$scuola_id = $_SESSION['scuola_id'] ?? null;

// accesso negato se l'utente non è registrato, lo mando a registrarsi
if($scuola_id === null && $utente_id === null) {
    header('Location: login.php');
    exit;
}

// dati della richiesta
$contenuto = $_REQUEST['contenuto'] ?? null;
$forum_id = $_REQUEST['forum_id'] ?? null;
$commento_padre = $_REQUEST['commento_padre'] ?? null;

if($forum_id === null || $contenuto === null){
    die("Parametri mancanti");
}

// Se il commento padre è una stringa "null", allora lo converto in null
if($commento_padre == "null" || $commento_padre === ''){
    $commento_padre = null;
}

createCommento($utente_id, $scuola_id, $forum_id, $commento_padre, $contenuto);

header('Location: forum.php?forum_id=' . $forum_id);

exit;