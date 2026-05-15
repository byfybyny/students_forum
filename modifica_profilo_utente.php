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

// Gestione invio form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuovo_username  = $_POST['username'] ?? '';
    $nuovo_nome      = $_POST['nome'] ?? '';
    $nuovo_cognome   = $_POST['cognome'] ?? '';
    $nuova_password  = $_POST['password'] ?? '';
    $nuova_bio       = $_POST['bio'] ?? '';
    $nuova_scuola    = $_POST['scuola'] ?? '';

    $stmt = $pdo->prepare("
        UPDATE utenti 
        SET nome = ?, cognome = ?, email = ?, biografia = ?, tipo = ?
        WHERE email = ?
    ");
    $stmt->execute([$nuovo_nome, $nuovo_cognome, $nuova_email, $nuova_bio, $nuovo_tipo, $email]);

    // Aggiorna la sessione
    $_SESSION['email'] = $nuova_email;
    $_SESSION['nome']  = $nuovo_nome;
    $_SESSION['tipo']  = $nuovo_tipo;

    header("Location: modifica_profilo.php");
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
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($utente['nome']) ?>">
        <br>

        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" value="<?= htmlspecialchars($utente['cognome']) ?>">
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($utente['email']) ?>">
        <br>

        <label for="bio">Biografia:</label>
        <textarea id="bio" name="bio"><?= htmlspecialchars($utente['biografia']) ?></textarea>
        <br>

        <label for="tipo">Scuola:</label>
        <select id="tipo" name="tipo">
            <option value="1" <?= $utente['tipo'] == 1 ? 'selected' : '' ?>>Liceo Scientifico</option>
            <option value="2" <?= $utente['tipo'] == 2 ? 'selected' : '' ?>>Istituto Tecnico Informatico</option>
            <option value="3" <?= $utente['tipo'] == 3 ? 'selected' : '' ?>>Liceo Classico</option>
            <option value="4" <?= $utente['tipo'] == 4 ? 'selected' : '' ?>>Istituto Professionale</option>
            <option value="5" <?= $utente['tipo'] == 5 ? 'selected' : '' ?>>Liceo Linguistico</option>
        </select>
        <br>

        <input type="submit" value="Salva Modifiche">
    </form>
</body>
</html>