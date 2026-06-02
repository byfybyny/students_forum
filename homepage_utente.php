<?php
session_start();
require_once "function.php";

global $pdo;

$email = $_SESSION['email'] ?? '';
$nome  = $_SESSION['nome']  ?? '';
$tipo  = $_SESSION['tipo']  ?? '';

$forum = getLast5Forum(0, 5);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Homepage Utente</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <script src="librerie/htmx.min.js"></script>
</head>
<body>
    <div class="forum-container">
        <h1>Benvenuto, <?= htmlspecialchars($nome) ?>!</h1>
        <div class="user-actions">
            <a href="pagina_creazione_forum.php" class="action-btn">✏️ Crea Forum</a>
            <a href="modifica_profilo_utente.php" class="action-btn">⚙️ Modifica Profilo</a>
            <a href="logout.php" class="action-btn logout">⏻ Logout</a>
        </div>

        <div class="forum-list" id="forum-body">
            <?php foreach ($forum as $row): ?>
            <div class="forum-card" onclick="window.location='forum.php?forum_id=<?= (int)$row['forum_id'] ?>'" style="cursor:pointer;">
                <h3><?= htmlspecialchars($row['titolo']) ?></h3>
                <div class="meta-info">
                    Creato da <a href="profilo_utente.php?utente_id=<?= (int)$row['utente_id'] ?>" onclick="event.stopPropagation()">
                        <strong><?= htmlspecialchars($row['username']) ?></strong>
                    </a>
                    il <?= htmlspecialchars($row['data_pubblicazione']) ?>
                </div>
            </div>
            <?php endforeach; ?>

            <div id="altri_forum"
                 hx-get="load_new_forum.php?offset=5&limit=5"
                 hx-trigger="revealed"
                 hx-swap="outerHTML">
                 <div class="card">Caricamento altri forum...</div>
            </div>
        </div>
    </div>
</body>
</html>