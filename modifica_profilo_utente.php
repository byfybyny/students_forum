<?php
session_start();
require_once "function.php";

global $pdo;

$email = $_SESSION['email'] ?? '';
$nome = $_SESSION['nome'] ?? '';
$tipo = $_SESSION['tipo'] ?? '';

// Recupera i dati attuali dell'utente dal DB
$stmt = $pdo->prepare("SELECT * FROM utenti WHERE email = ?");
$stmt->execute([$email]);
$utente = $stmt->fetch(PDO::FETCH_ASSOC);

$scuola = getScuolaByScuolaId($utente['scuola_id']);

//recupera tutte le scuole per il menu a tendina
$stmt = $pdo->query("SELECT scuola_id, nome FROM scuole ORDER BY nome");
$scuole = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Gestione invio form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuovo_username  = $_POST['username'] ?? '';
    $nuovo_nome      = $_POST['nome'] ?? '';
    $nuovo_cognome   = $_POST['cognome'] ?? '';
    $nuova_password  = $_POST['password'] ?? '';
    $nuova_bio       = $_POST['bio'] ?? '';
    $nuova_scuola    = $_POST['scuola'] ?? '';

    echo "Dati ricevuti: $nuovo_username, $nuovo_nome, $nuovo_cognome, $nuova_password, $nuova_bio, $nuova_scuola";

    $pwd_hash = password_hash($nuova_password, PASSWORD_DEFAULT);
     
    $stmt = $pdo->prepare("
        UPDATE utenti 
        SET username = ?,nome = ?, cognome = ?, password_hash = ?, descrizione = ?, scuola_id = ?
        WHERE email = ?
    ");
    $stmt->execute([$nuovo_username, $nuovo_nome, $nuovo_cognome, $pwd_hash, $nuova_bio, $nuova_scuola, $email]);


    header("Location: logout.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Modifica Profilo</title>
</head>
<body>
    <h1>Modifica Profilo</h1>
    <a href="homepage_utente.php">Ritorna All'Homepage</a>
    <br><br>

    <form method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?= htmlspecialchars($utente['username']) ?>">
    <br>

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($utente['nome']) ?>">
    <br>

    <label for="cognome">Cognome:</label>
    <input type="text" id="cognome" name="cognome" value="<?= htmlspecialchars($utente['cognome']) ?>">
    <br>

    <label for="password">Nuova Password:</label>
    <input type="password" id="password" name="password" placeholder="Lascia vuoto per non cambiarla">
    <br>

    <label for="bio">Biografia:</label>
    <textarea id="bio" name="bio"><?= htmlspecialchars($utente['descrizione']) ?></textarea>
    <br>


    <label for="scuola">Scuola:</label>
    <select id="scuola" name="scuola">
        <?php foreach ($scuole as $s): ?>
            <option value="<?= $s['scuola_id'] ?>" 
                <?= $utente['scuola_id'] == $s['scuola_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($s['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Salva Modifiche">
</form>
</body>
</html>