<?php
session_start();
require_once "function.php";
global $pdo;

$nome     = $_SESSION['nome']     ?? '';
$scuola_id = $_SESSION['scuola_id'] ?? 0;

$forum        = getForumByScuola($scuola_id, 0, 5);
$numStudenti  = getNumStudenti($scuola_id);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Homepage Scuola</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="librerie/htmx.min.js"></script>
</head>
<body>
    <div class="forum-container">
        <h1>Benvenuto, <?= htmlspecialchars($nome) ?>!</h1>
        <p>Studenti iscritti alla tua scuola: <strong><?= $numStudenti ?></strong></p>

        <div class="user-actions">
            <a href="modifica_profilo_scuola.php" class="action-btn">
                ⚙️ Modifica Profilo
            </a>
            <a href="logout.php" class="action-btn logout">
                ⏻ Logout
            </a>
        </div>

        <h2>Forum dei tuoi studenti</h2>
        
        <div class="forum-list" id="forum-body">
            <?php foreach ($forum as $row): ?>
            <a href="forum.php?forum_id=<?= (int)$row['forum_id'] ?>" class="forum-card">
                <h3><?= htmlspecialchars($row['titolo']) ?></h3>
                <div class="meta-info">
                    Creato da <?= htmlspecialchars($row['username']) ?> il <?= htmlspecialchars($row['data_pubblicazione']) ?>
                </div>
            </a>
            <?php endforeach; ?>

            <div id="altri_forum"
                 hx-get="load_more_scuola.php?offset=5&limit=5&scuola_id=<?= $scuola_id ?>"
                 hx-trigger="revealed"
                 hx-swap="outerHTML">
                 <div class="card">Caricamento altri forum...</div>
            </div>
        </div>
    </div>
</body>
</html>