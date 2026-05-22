<?php

require_once "function.php";

session_start();

$utente_id = $_SESSION['utente_id'] ?? null;
$titolo = $_REQUEST['titolo'] ?? null;
$contenuto = $_REQUEST['contenuto'] ?? null;

if($utente_id === null) {
    header('Location: login.php');
    exit;
}
else if($titolo === null || $contenuto === null) {
    header('Location: pagina_creazione_forum.php?errore=true');
    exit;
}

createForum($utente_id, $titolo, $contenuto);

header('Location: pagina_creazione_forum.php?errore=false');

exit;
