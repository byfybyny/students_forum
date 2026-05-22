<?php
session_start();
require_once "function.php";

global $pdo;

$errore = "";

// recupera tutte le scuole per il menu a tendina
$stmt = $pdo->query("SELECT scuola_id, nome FROM scuole ORDER BY nome");
$scuole = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username  = $_POST['username']  ?? '';
    $nome      = $_POST['nome']      ?? '';
    $cognome   = $_POST['cognome']   ?? '';
    $email     = $_POST['email']     ?? '';
    $password  = $_POST['password']  ?? '';
    $bio       = $_POST['bio']       ?? '';
    $scuola_id = $_POST['scuola']    ?? '';

    if ($username === '' || $nome === '' || $cognome === '' || $email === '' || $password === '') {
        $errore = "Compila tutti i campi obbligatori.";
    } else {
        // controlla se email o username già esistono
        $stmt = $pdo->prepare("SELECT utente_id FROM utenti WHERE email = ? OR username = ?");
        $stmt->execute([$email, $username]);
        if ($stmt->fetch()) {
            $errore = "Email o username già in uso.";
        } else {
            $pwd_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("
                INSERT INTO utenti (username, nome, cognome, email, password_hash, descrizione, scuola_id)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$username, $nome, $cognome, $email, $pwd_hash, $bio, $scuola_id]);
            header("Location: login.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Registrazione Studente</title>
</head>
<body>
    <h1>Registrati come Studente</h1>
    <a href="login.php">Torna al Login</a>
    <br><br>

    <?php if ($errore !== ''): ?>
        <p style="color:red;"><?= $errore ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>

        <label>Nome:</label>
        <input type="text" name="nome" required>
        <br>

        <label>Cognome:</label>
        <input type="text" name="cognome" required>
        <br>

        <label>Email:</label>
        <input type="email" name="email" required>
        <br>

        <label>Password:</label>
        <input type="password" name="password" required>
        <br>

        <label>Biografia:</label>
        <textarea name="bio"></textarea>
        <br>

        <label>Scuola:</label>
        <select name="scuola">
            <option value="">-- Seleziona scuola --</option>
            <?php foreach ($scuole as $s): ?>
                <option value="<?= $s['scuola_id'] ?>"><?= htmlspecialchars($s['nome']) ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <input type="submit" value="Registrati">
    </form>
</body>
</html>