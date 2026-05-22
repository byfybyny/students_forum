<?php

require_once "function.php";

session_start();

$email = $_SESSION['email'] ?? null;
$errore = $_REQUEST['errore'] ?? null;

if($email === null) {
    header('Location: login.php');
    exit;
}

$utente_id = getUserIdByEmail($email);

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