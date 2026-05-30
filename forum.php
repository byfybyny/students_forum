<?php

require_once "function.php";

// dati dell'utente
session_start();
$email = $_SESSION['email'] ?? null;

// accesso negato se l'utente non è registrato, lo mando a registrarsi
if($email === null) {
    header('Location: login.php');
    exit;
}

// dati del forum
$forum_id = $_REQUEST['forum_id'] ?? null;
$forum = getForumByForumId($forum_id);

if ($forum_id === null || $forum === false) {
    die("Forum non trovato");
}

//dati del file
$files = getFilesByForumId($forum_id);

// dati relativi alla cancellazione di un commento
$eliminato = $_REQUEST['eliminato'] ?? null;

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <title>Forum: <?=$forum['titolo']?></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="librerie/htmx.min.js"></script>
</head>
<body>
    <a href="login.php" class="back-link">← Torna indietro</a>
    
    <?php if ($eliminato !== null): ?>
        <div class="alert <?= $eliminato == 'true' ? 'success' : 'error' ?>">
            <?= $eliminato === 'true' ? 'Commento eliminato con successo.' : 'Errore durante l\'eliminazione del commento.' ?>
        </div>
    <?php endif; ?>

    <div class="forum-container">
        <div class="card forum-header">
            <h1><?=$forum['titolo']?></h1>
            <p>Creato da <a href="profilo_utente.php?utente_id=<?= (int)$forum['utente_id'] ?>"><strong><?= htmlspecialchars($forum['username']) ?></strong></a> il <?= $forum['data_pubblicazione'] ?></p>
            <p><?=$forum['contenuto']?></p>
        </div>

        <button id="pagina_aggiungi_commento"
                hx-get="pagina_aggiunta_commento.php?forum_id=<?=$forum_id?>"
                hx-target="#pagina_aggiungi_commento"
                hx-swap="outerHTML">
            + Aggiungi commento
        </button>

        <h2>Commenti</h2>
        <div id="lista_commenti" class="comment-list" hx-get="commenti.php?forum_id=<?=$forum_id?>" hx-trigger="revealed">
            <div class="card">Caricamento...</div>
        </div>
    </div>
</body>
</html>