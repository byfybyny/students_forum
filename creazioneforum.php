<?php

require_once "function.php";

$utente_id = $_REQUEST['utente_id'] ?? null;
$titolo = $_REQUEST['titolo'] ?? null;
$contenuto = $_REQUEST['contenuto'] ?? null;

if($utente_id === null || $titolo === null || $contenuto === null) {
    header('Location: pagina_creazione_forum.php?errore=true');
    exit;
}

createForum($utente_id, $titolo, $contenuto);
