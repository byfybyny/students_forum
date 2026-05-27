<?php

require_once "function.php";

// dati dell'utente
session_start();
$email = $_SESSION['email'] ?? null;

if($email === null) {
    header('Location: login.php');
    exit;
}

// dati del forum
$forum_id = $_REQUEST['forum_id'] ?? null;
$forum = getForumByForumId($forum_id);

if ($forum_id === null || $forum === false) {
    header('Location: login.php');
    exit;
}

//dati del file
$files = getFilesByForumId($forum_id);

?>

<<!DOCTYPE html>
<html lang="it">
<head>
    <title>Forum: <?=$forum['titolo']?></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="librerie/htmx.min.js"></script>
</head>
<body>
    <a href="login.php" class="back-link">← Torna indietro</a>
    
    <div class="forum-container">
        <div class="card forum-header">
            <h1><?=$forum['titolo']?></h1>
            <p>Creato da <strong><?=$forum['username']?></strong> il <?=$forum['data_pubblicazione']?></p>
            <p><?=$forum['contenuto']?></p>
        </div>

        <button id="aggiungi_commento" hx-get="pagina_aggiunta_commento.php?forum_id=<?=$forum_id?>" hx-target="#aggiungi_commento">
            + Aggiungi commento
        </button>

        <h2>Commenti</h2>
        <div id="commenti" class="comment-list" hx-get="commenti.php?forum_id=<?=$forum_id?>" hx-trigger="revealed">
            <div class="card">Caricamento...</div>
        </div>
    </div>
</body>
</html>
