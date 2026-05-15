<?php
session_start();
require_once "function.php";
global $pdo;



$email = $_SESSION['email'] ?? '';
$nome = $_SESSION['nome'] ?? '';
$tipo = $_SESSION['tipo'] ?? '';

$ultimi30Forum = getLast30Forum();

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Homepage Scuola</title>
</head>
<body>
    <h1>Benvenuto, <?php echo $nome; ?>!</h1>
    <p>Questa è la homepage del tua scuola.</p>

    <a href="logout.php">Logout</a>
    <br>
    <a href="modifica_profilo_scuola.php">Modifica Profilo</a>

    <table>
        <thead>
            <tr>
                <th>Titolo</th>
                <th>Username</th>
                <th>Data di Creazione</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ultimi30Forum as $forum) { ?>
                <tr>
                    <td>
                        <a href="forum.php?forum_id=<?= $forum['forum_id'] ?>">
                            <?php echo htmlspecialchars($forum['titolo']); ?>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars($forum['username']); ?></td>
                    <td><?php echo htmlspecialchars($forum['data_pubblicazione']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>




