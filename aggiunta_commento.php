<?php
require_once "function.php";
session_start();

$utente_id = $_SESSION['utente_id'] ?? null;
$scuola_id = $_SESSION['scuola_id'] ?? null;

if($scuola_id === null && $utente_id === null) {
    header('Location: login.php');
    exit;
}

$contenuto = $_REQUEST['contenuto'] ?? null;

// 1. Cast forzato a intero
$forum_id = isset($_REQUEST['forum_id']) ? (int)$_REQUEST['forum_id'] : 0;
$commento_padre = !empty($_REQUEST['commento_padre']) && $_REQUEST['commento_padre'] !== "null" ? (int)$_REQUEST['commento_padre'] : null;

// 2. Recupero dal padre se necessario
if ($forum_id === 0 && $commento_padre !== null) {
    $forum_id = getForumIdFromCommentoId($commento_padre);
}

// Controllo finale
if($forum_id <= 0 || empty($contenuto)){
    die("Parametri mancanti o non validi");
}

// 3. Ora i tipi sono garantiti: $forum_id è int, $commento_padre è int o null
createCommento($utente_id, $scuola_id, $forum_id, $commento_padre, $contenuto);

header('Location: forum.php?forum_id=' . $forum_id);
exit;