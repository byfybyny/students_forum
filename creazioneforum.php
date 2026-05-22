<?php

require_once "function.php";

$email = $_SESSION['email'] ?? null;

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

        <form action="creazioneforum_action.php" method="post">
            <label for="titolo">Titolo</label>
            <input type="text" name="titolo" id="titolo" required>
            <br>
            <label for="contenuto">Contenuto</label>
            <textarea name="contenuto" id="contenuto" required></textarea>
            <br>
        </form>
    </body>
</html>