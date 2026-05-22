<?php

require_once "function.php";

session_start();

$utente_id = $_SESSION['utente_id'] ?? null;
$errore = $_REQUEST['errore'] ?? null;

if($utente_id === null) {
    header('Location: login.php');
    exit;
}

?>
<html>
    <head>
        <title>Creazione forum</title>
    </head>

    <body>
        <h1>Creazione forum</h1>
        <?php if($errore === 'true'): ?>
            <p style="color: red;">Tutti i campi sono obbligatori</p>
        <?php endif; ?>
        <?php if($errore === 'false'): ?>
            <p style="color: green;">Forum creato con successo</p>
        <?php endif; ?>
        <form action="creazione_forum.php?utente_id=<?=$utente_id?>" method="post">
            <label for="titolo">Titolo</label>
            <input type="text" name="titolo" id="titolo" required>
            <br>
            <label for="contenuto">Contenuto</label>
            <textarea name="contenuto" id="contenuto" required></textarea>
            <br>
            <button type="submit">Crea forum</button>
        </form>
    </body>
</html>