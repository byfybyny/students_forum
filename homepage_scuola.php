<?php
session_start();
require_once "function.php";
global $pdo;

$nome      = $_SESSION['nome']      ?? '';
$scuola_id = $_SESSION['scuola_id'] ?? 0;

$modalita    = isset($_GET['modalita']) && $_GET['modalita'] === 'tutti' ? 'tutti' : 'scuola';
$numStudenti = getNumStudenti($scuola_id);

if ($modalita === 'tutti') {
    $forum = getLast5Forum(0, 5);
} else {
    $forum = getForumByScuola($scuola_id, 0, 5);
}
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
        <p>Studenti iscritti alla tua scuola: <strong><?= (int)$numStudenti ?></strong></p>

        <div class="user-actions">
            <a href="modifica_profilo_scuola.php" class="action-btn">⚙️ Modifica Profilo</a>
            <a href="logout.php" class="action-btn logout">⏻ Logout</a>
        </div>

        <h2>Forum</h2>

        <div style="display:flex; flex-direction:row; gap:1rem; margin-bottom:1rem;">
            <a href="?modalita=scuola" 
                style="background:<?= $modalita==='scuola' ? '#ff4500' : 'white' ?>; color:<?= $modalita==='scuola' ? 'white' : '#1c1c1c' ?>; border:1px solid <?= $modalita==='scuola' ? '#ff4500' : '#ccc' ?>; padding:8px 16px; border-radius:20px; text-decoration:none; font-size:0.9em; font-weight:500; white-space:nowrap;">
                    🏫 La mia scuola
            </a>

            <a href="?modalita=tutti"
                style="background:<?= $modalita==='tutti' ? '#ff4500' : 'white' ?>; color:<?= $modalita==='tutti' ? 'white' : '#1c1c1c' ?>; border:1px solid <?= $modalita==='tutti' ? '#ff4500' : '#ccc' ?>; padding:8px 16px; border-radius:20px; text-decoration:none; font-size:0.9em; font-weight:500; white-space:nowrap;">
                    🌐 Tutti i forum
            </a>
        </div>

        <div class="forum-list" id="forum-body">
            <?php foreach ($forum as $row): ?>
            <a href="forum.php?forum_id=<?= (int)$row['forum_id'] ?>" class="forum-card">
                <h3><?= htmlspecialchars($row['titolo']) ?></h3>
                <div class="meta-info">
                    Creato da <strong><?= htmlspecialchars($row['username']) ?></strong>
                    il <?= htmlspecialchars($row['data_pubblicazione']) ?>
                </div>
            </a>
            <?php endforeach; ?>

            <div id="altri_forum"
                 hx-get="load_more_scuola.php?modalita=<?= $modalita ?>&scuola_id=<?= (int)$scuola_id ?>&offset=5&limit=5"
                 hx-trigger="revealed"
                 hx-target="#altri_forum"
                 hx-swap="outerHTML">
                <div class="card">Caricamento altri forum...</div>
            </div>
        </div>
    </div>
</body>
</html>