<?php

require_once "function.php";

// dati dell'utente
session_start();
$email = $_SESSION['email'] ?? null;
$tipo = $_SESSION['tipo'] ?? null;

if(!isset($email, $tipo)) {
    header('Location: login.php');
    exit;
}

// dati del forum
$forum_id = $_REQUEST['forum_id'] ?? null;
$forum = getForumByForumId($forum_id);

if ($forum_id === null || $forum === false) {
    if($tipo === 'scuola') {
        header('Location: homepage_scuola.php');
    } else {
        header('Location: homepage_utente.php');
    }
    exit;
}

//dati del file
$files = getFilesByForumId($forum_id);

?>

<!DOCTYPE html>
<html lang="it">
    <head></head></head>
        <title>Forum: <?=$forum['titolo']?></title>
    </head>

    <body>
        <h1><?=$forum['titolo']?></h1>
        <h3>creato da <?=$forum['username']?> il <?=$forum['data_pubblicazione']?></h3>
        <p><?=$forum['contenuto']?></p>
    </body>
</html>


