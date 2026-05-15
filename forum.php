<?php

require_once "function.php";

session_start();
$email = $_SESSION['email'] ?? null;
$tipo = $_SESSION['tipo'] ?? null;

if(!isset($email, $tipo)) {
    header('Location: login.php');
    exit;
}

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

?>

<!DOCTYPE html>
<html lang="it">
    <head></head></head>
        <title>Forum: <?=$forum['titolo']?></title>
    </head>

    <body>
        <h1><?=$forum['titolo']?></h1>
        <p><?=$forum['descrizione']?></p>

        <!-- Qui puoi aggiungere il codice per visualizzare i commenti e il form per aggiungere nuovi commenti -->

    </body>
</html>


