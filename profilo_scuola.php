<?php
    session_start(); 

    require_once "function.php";

    global $pdo;

    $id_scuola = $_GET['scuola_id'] ?? '';

    if($id_scuola === '') {
        header("Location: logout.php");
    }

    $stmt = $pdo->prepare("SELECT * FROM scuole WHERE scuola_id = ?");
    $stmt->execute([$id_scuola]);
    $scuola = $stmt->fetch();  

    //print_r($scuola);
    
    ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Profilo Scuola</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- href per tornare alla pagina precedente, per non dover gestire l'url di ritorno in modo dinamico -->
    <a href="javascript:history.back()" class="action-btn" style="display:inline-block; margin-bottom:20px;">← Torna indietro</a>
    <h3>Profilo Scuola: <?php echo htmlspecialchars($scuola['nome'] ?? ''); ?></h3>
    <p><strong>Indirizzo:</strong> <?php echo htmlspecialchars($scuola['indirizzo'] ?? ''); ?></p>
    <p><strong>Città:</strong> <?php echo htmlspecialchars($scuola['citta'] ?? ''); ?></p>
    <p><strong>Provincia:</strong> <?php echo htmlspecialchars($scuola['provincia'] ?? ''); ?></p>
    <p><strong>CAP:</strong> <?php echo htmlspecialchars($scuola['cap'] ?? ''); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($scuola['email'] ?? ''); ?></p>
    <p><strong>Telefono:</strong> <?php echo htmlspecialchars($scuola['telefono'] ?? ''); ?></p>
</body>
</html>