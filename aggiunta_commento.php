<?php

require_once "function.php";

session_start();

$contenuto = $_REQUEST['contenuto'] ?? null;
$forum_id = $_REQUEST['forum_id'] ?? null;
$email = $_SESSION['email'] ?? null;
$commento_padre = $_REQUEST['commento_padre'] ?? null;

if($email === null || $forum_id === null || $contenuto === null) {
    header('Location: login.php');
    exit;
}

if($commento_padre == null){
    $commento_padre = null;
}

$utente_id = getUserIdByEmail($email);

createCommento($utente_id, $forum_id, $commento_padre, $contenuto);

header('Location: forum.php?forum_id=' . $forum_id);

exit;