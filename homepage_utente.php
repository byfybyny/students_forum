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
    <script src="librerie/htmx.min.js"></script>
</head>
<body>
    <h1>Benvenuto, <?php echo $nome; ?>!</h1>
    <p>Questa è la homepage del tuo profilo.</p>

    <a href="logout.php">Logout</a> |
    <a href="modifica_profilo_utente.php">Modifica Profilo</a>

    <table>
        <thead>
            <tr>
                <th>Titolo</th>
                <th>Username</th>
                <th>Data di Creazione</th>
            </tr>
        </thead>
        <tbody id="forum-body">
            <?php foreach ($forum as $row): ?>
            <tr>
                <td>
                    <a href="forum.php?forum_id=<?= (int)$row['forum_id'] ?>">
                        <?= $row['titolo']?>
                    </a>
                </td>
                <td><?= $row['username']?></td>
                <td><?= $row['data_pubblicazione']?></td>
            </tr>
            <?php endforeach; ?>

            <tr id="altri_forum"
                hx-get="/students_forum/load_new_forum.php?offset=5&limit=5"
                hx-trigger="revealed"
                hx-target="#altri_forum"
                hx-swap="outerHTML">
            </tr>
        </tbody>
    </table>
</body>
</html>