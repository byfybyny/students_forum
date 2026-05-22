<?php

require_once "function.php";

$contenuto = $_REQUEST['contenuto'] ?? null;
$forum_id = $_REQUEST['forum_id'] ?? null;
$email = $_SESSION['email'] ?? null;

if($email === null || $forum_id === null || $contenuto === null) {
    header('Location: login.php');
    exit;
}

$utente_id = getUserIdByEmail($email);

createCommento($utente_id, $forum_id, null, $contenuto);