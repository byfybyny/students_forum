<?php
session_start();
require_once "function.php";
global $pdo;


$email = $_SESSION['email'] ?? '';
$nome = $_SESSION['nome'] ?? '';
$tipo = $_SESSION['tipo'] ?? '';

?>
<!DOCTYPE html>
<html lang="it">      
    <head>
        <title>Homepage Scuola</title>
    </head>

    <body>
        <h1>Benvenuto, <?php echo $nome; ?>!</h1>
        <p>Questa è la homepage della tua scuola.</p>

        <a href="logout.php">Logout</a>
    </body>
</html>




