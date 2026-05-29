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
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="forum-container">
 
        <div class="form-card">
            <h1>Registrati come Scuola</h1>
            <a href="login.php" class="action-btn" style="display:inline-block; margin-bottom:20px;">← Torna al Login</a>
 
            <?php if ($errore !== ''): ?>
                <div class="alert error"><?= htmlspecialchars($errore) ?></div>
            <?php endif; ?>
 
            <form method="post">
                <div class="form-group">
                    <label>Nome Scuola *</label>
                    <input type="text" name="nome" required>
                </div>
                <div class="form-group">
                    <label>Indirizzo</label>
                    <input type="text" name="indirizzo">
                </div>
                <div class="form-group">
                    <label>Città</label>
                    <input type="text" name="citta">
                </div>
                <div class="form-group">
                    <label>Provincia</label>
                    <input type="text" name="provincia">
                </div>
                <div class="form-group">
                    <label>CAP</label>
                    <input type="text" name="cap">
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Telefono</label>
                    <input type="text" name="telefono">
                </div>
                <div class="form-group">
                    <label>Password *</label>
                    <input type="password" name="password" required>
                </div>
 
                <button type="submit" class="submit-btn">Registrati</button>
            </form>
        </div>
 
    </div>
</body>
</html>