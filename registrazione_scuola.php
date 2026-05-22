<?php
session_start();
require_once "function.php";

global $pdo;

$errore = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = $_POST['nome']      ?? '';
    $indirizzo = $_POST['indirizzo'] ?? '';
    $citta     = $_POST['citta']     ?? '';
    $provincia = $_POST['provincia'] ?? '';
    $cap       = $_POST['cap']       ?? '';
    $email     = $_POST['email']     ?? '';
    $telefono  = $_POST['telefono']  ?? '';
    $password  = $_POST['password']  ?? '';

    if ($nome === '' || $email === '' || $password === '') {
        $errore = "Compila tutti i campi obbligatori.";
    } else {
        // controlla se email già esiste
        $stmt = $pdo->prepare("SELECT scuola_id FROM scuole WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errore = "Email già in uso.";
        } else {
            $pwd_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("
                INSERT INTO scuole (nome, indirizzo, citta, provincia, cap, email, telefono, password_hash)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$nome, $indirizzo, $citta, $provincia, $cap, $email, $telefono, $pwd_hash]);
            header("Location: login.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Registrazione Scuola</title>
</head>
<body>
    <h1>Registrati come Scuola</h1>
    <a href="login.php">Torna al Login</a>
    <br><br>

    <?php if ($errore !== ''): ?>
        <p style="color:red;"><?= $errore ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nome Scuola:</label>
        <input type="text" name="nome" required>
        <br>

        <label>Indirizzo:</label>
        <input type="text" name="indirizzo">
        <br>

        <label>Città:</label>
        <input type="text" name="citta">
        <br>

        <label>Provincia:</label>
        <input type="text" name="provincia">
        <br>

        <label>CAP:</label>
        <input type="text" name="cap">
        <br>

        <label>Email:</label>
        <input type="email" name="email" required>
        <br>

        <label>Telefono:</label>
        <input type="text" name="telefono">
        <br>

        <label>Password:</label>
        <input type="password" name="password" required>
        <br>

        <input type="submit" value="Registrati">
    </form>
</body>
</html>