<?php
session_start();

if (isset($_SESSION['email'], $_SESSION['tipo'])) {
    header('Location: ' . ($_SESSION['tipo'] === 'scuola' ? 'homepage_scuola.php' : 'homepage_utente.php'));
    exit;
}

require_once "function.php";

$errore = "";

if (($_POST['btnAction'] ?? '') === 'login') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $errore = 'Compila tutti i campi.';

    } else {
        $log = checkPassword($email, $password);

        if ($log !== false) {
            $_SESSION['email'] = $log['email'];
            $_SESSION['tipo'] = $log['tipo'];
            $_SESSION['nome'] = $log['nome'];
            if ($log['tipo'] === 'scuola') {
                $_SESSION['scuola_id'] = $log['scuola_id'];
            }

            header('Location: ' . ($log['tipo'] === 'scuola' ? 'homepage_scuola.php' : 'homepage_utente.php'));
            exit;

        } else {
            $errore = 'Credenziali non valide.';
        }
    }
}
?>
<Doctype html>
<html lang="it">      
    <head>
        <title>Login</title>
    </head>

    <body>
        <h1>Login</h1>
        <?php if (isset($errore)) { echo "<p style='color:red;'>$errore</p>"; } ?>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="btnAction" value="login">Accedi</button>
        </form> 
        <br>
        <a href="registrazione_utente.php">Registrati come studente</a>
        <br>
        <a href="registrazione_scuola.php">Registrati come scuola</a>
    </body>
</html>