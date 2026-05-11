<?php
session_start();

if (isset($_SESSION['email'], $_SESSION['tipo'])) {
    header('Location: ' . ($_SESSION['tipo'] === 'scuola' ? 'homepage_scuola.php' : 'homepage_utente.php'));
    exit;
}
 
$errore = "";

require_once "function.php";

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



    </head>

    <body>
        <h1>Login</h1>
        <?php if (isset($errore)) { echo "<p style='color:red;'>$errore</p>"; } ?>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="btnAction" value="login">Accedi</button>
        </form> 
    </body>





</html>