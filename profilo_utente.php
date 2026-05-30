<?php
    session_start(); 

    require_once "function.php";

    global $pdo;

    $id_profilo = $_GET['utente_id'] ?? '';



    if($id_profilo === '') {
        header("Location: logout.php");
    }

    $stmt = $pdo->prepare("SELECT * FROM utenti WHERE utente_id = ?");
    $stmt->execute([$id_profilo]);
    $profilo = $stmt->fetch();  

    //print_r($profilo);

    $stmt = $pdo->prepare("SELECT * FROM scuole WHERE scuola_id = ?");
    $stmt->execute([$profilo['scuola_id']]);
    $scuola = $stmt->fetch();

    //print_r($scuola);

    $data = $profilo['data_registrazione'] ?? '';
    $data_ora = explode(' ', $data);
    $data = $data_ora[0] ?? '';


?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Profilo Utente</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- href per tornare alla pagina precedente, per non dover gestire l'url di ritorno in modo dinamico -->
    <a href="javascript:history.back()" class="action-btn" style="display:inline-block; margin-bottom:20px;">← Torna indietro</a>
    <h3>Profilo Utente: <?php echo htmlspecialchars($profilo['username'] ?? ''); ?></h3>
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($profilo['nome'] ?? ''); ?></p>
    <p><strong>Cognome:</strong> <?php echo htmlspecialchars($profilo['cognome'] ?? ''); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($profilo['email'] ?? ''); ?></p>
    <p><strong>Scuola:</strong> <a href="profilo_scuola.php?scuola_id=<?php echo htmlspecialchars($scuola['scuola_id'] ?? ''); ?>"><?php echo htmlspecialchars($scuola['nome'] ?? ''); ?></a></p>
    <p><strong>Data Di Iscrizione:</strong> <?php echo htmlspecialchars($data); ?></p>
    <p><strong>Descrizione:</strong> <?php echo htmlspecialchars($profilo['descrizione'] ?? ''); ?></p>
</body>
</html>
