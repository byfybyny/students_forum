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
    <script src="librerie/htmx.min.js"></script>
</head>
<body>
    <h1>Benvenuto, <?= $nome ?>!</h1>
    <p>Studenti iscritti alla tua scuola: <strong><?= $numStudenti ?></strong></p>

    <a href="logout.php">Logout</a> |
    <a href="modifica_profilo_scuola.php">Modifica Profilo</a>

    <h2>Forum dei tuoi studenti</h2>
    <table>
        <thead>
            <tr>
                <th>Titolo</th>
                <th>Username</th>
                <th>Data di Creazione</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($forum as $row): ?>
            <tr>
                <td>
                    <a href="forum.php?forum_id=<?= (int)$row['forum_id'] ?>">
                        <?= htmlspecialchars($row['titolo']) ?>
                    </a>
                </td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['data_pubblicazione']) ?></td>
            </tr>
            <?php endforeach; ?>

            <tr id="altri_forum"
                hx-get="/students_forum/load_more_scuola.php?offset=5&limit=5&scuola_id=<?= $scuola_id ?>"
                hx-trigger="revealed"
                hx-target="#altri_forum"
                hx-swap="outerHTML">
            </tr>
        </tbody>
    </table>
</body>
</html>