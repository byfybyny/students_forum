<?php
require_once "function.php";
session_start();

$utente_id = $_SESSION['utente_id'] ?? null;
$errore    = $_REQUEST['errore']    ?? null;

if ($utente_id === null) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Crea Forum</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="forum-container">

        <div class="user-actions">
            <a href="homepage_utente.php" class="action-btn">← Torna all'Homepage</a>
        </div>

        <?php if ($errore === 'true'): ?>
            <div class="alert error">Tutti i campi sono obbligatori.</div>
        <?php endif; ?>
        <?php if ($errore === 'false'): ?>
            <div class="alert success">Forum creato con successo!</div>
        <?php endif; ?>

        <div class="form-card">
            <h1>Crea un nuovo Forum</h1>
            <form action="creazione_forum.php" method="post">
                <div class="form-group">
                    <label for="titolo">Titolo *</label>
                    <input type="text" name="titolo" id="titolo" required>
                </div>
                <div class="form-group">
                    <label for="contenuto">Contenuto *</label>
                    <textarea name="contenuto" id="contenuto" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Crea Forum</button>
            </form>
        </div>

    </div>
</body>
</html>