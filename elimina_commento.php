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
if (empty($forum_id)) {
    $forum_id = getForumIdFromCommentoId($commento_id); 
}

$is_eliminato = false;
if($scuola_id !== null){
    $is_eliminato = deleteCommento($commento_id, $scuola_id, 'scuola');
}
else{
    $is_eliminato = deleteCommento($commento_id, $utente_id, 'utente');
}

if ($is_eliminato) {
    // Risposta HTMX: il div viene rimosso dal DOM senza ricaricare
    echo ""; 
} else {
    // Se fallisce, restituiamo un errore (opzionale)
    http_response_code(500);
    echo "Errore nell'eliminazione";
}