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
            $_SESSION['utente_id'] = $log['utente_id'];
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
<!DOCTYPE html>
<html lang="it">      
<head>
    <meta charset="UTF-8">
    <title>Login - Forum Studenti</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Stile aggiuntivo specifico per la pagina di login */
        body { display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .login-card { width: 100%; max-width: 400px; }
        .error-msg { background: #fdf2f2; color: #e74c3c; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 0.9em; }
    </style>
</head>

<body>
    <div class="login-card card">
        <h1>Login</h1>
        <?php if ($errore): ?>
            <div class="error-msg"><?= htmlspecialchars($errore) ?></div>
        <?php endif; ?>

        <form method="post" class="form-group">
            <input type="email" name="email" placeholder="Email" required style="width: 100%; margin-bottom: 10px; padding: 10px; border: 1px solid var(--border-color); border-radius: 4px;">
            <input type="password" name="password" placeholder="Password" required style="width: 100%; margin-bottom: 15px; padding: 10px; border: 1px solid var(--border-color); border-radius: 4px;">
            <button type="submit" name="btnAction" value="login" class="submit-btn" style="width: 100%;">Accedi</button>
        </form> 
        
        <hr style="margin: 20px 0; border: 0; border-top: 1px solid var(--border-color);">
        
        <div class="auth-links">
            <a href="registrazione_utente.php">Studente</a>
            <a href="registrazione_scuola.php">Scuola</a>
        </div>
    </div>
</body>
</html>