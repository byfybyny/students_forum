<?php
session_start();
require_once "function.php";

global $pdo;

$email     = $_SESSION['email']     ?? '';
$scuola_id = $_SESSION['scuola_id'] ?? 0;

// Recupera i dati attuali della scuola dal DB
$stmt = $pdo->prepare("SELECT * FROM scuole WHERE email = ?");
$stmt->execute([$email]);
$scuola = $stmt->fetch(PDO::FETCH_ASSOC);

// Gestione invio form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuovo_nome      = $_POST['nome']      ?? '';
    $nuovo_indirizzo = $_POST['indirizzo'] ?? '';
    $nuova_citta     = $_POST['citta']     ?? '';
    $nuova_provincia = $_POST['provincia'] ?? '';
    $nuovo_cap       = $_POST['cap']       ?? '';
    $nuovo_telefono  = $_POST['telefono']  ?? '';
    $nuova_password  = $_POST['password']  ?? '';

    if ($nuova_password !== '') {
        $pwd_hash = password_hash($nuova_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("
            UPDATE scuole 
            SET nome = ?, indirizzo = ?, citta = ?, provincia = ?, cap = ?, telefono = ?, password_hash = ?
            WHERE email = ?
        ");
        $stmt->execute([$nuovo_nome, $nuovo_indirizzo, $nuova_citta, $nuova_provincia, $nuovo_cap, $nuovo_telefono, $pwd_hash, $email]);
    } else {
        $stmt = $pdo->prepare("
            UPDATE scuole 
            SET nome = ?, indirizzo = ?, citta = ?, provincia = ?, cap = ?, telefono = ?
            WHERE email = ?
        ");
        $stmt->execute([$nuovo_nome, $nuovo_indirizzo, $nuova_citta, $nuova_provincia, $nuovo_cap, $nuovo_telefono, $email]);
    }

    $_SESSION['nome'] = $nuovo_nome;
    header("Location: homepage_scuola.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Modifica Profilo Scuola</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="forum-container">
        <h1>Modifica Profilo Scuola</h1>
        <a href="homepage_scuola.php">← Ritorna all'homepage</a>

        <div class="form-card">
            <form method="post">
                <div class="form-group">
                    <label for="nome">Nome Scuola:</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($scuola['nome']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="indirizzo">Indirizzo:</label>
                    <input type="text" id="indirizzo" name="indirizzo" value="<?= htmlspecialchars($scuola['indirizzo']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="citta">Città:</label>
                    <input type="text" id="citta" name="citta" value="<?= htmlspecialchars($scuola['citta']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="provincia">Provincia:</label>
                    <input type="text" id="provincia" name="provincia" value="<?= htmlspecialchars($scuola['provincia']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="cap">CAP:</label>
                    <input type="text" id="cap" name="cap" value="<?= htmlspecialchars($scuola['cap']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Telefono:</label>
                    <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($scuola['telefono']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="password">Nuova Password:</label>
                    <input type="password" id="password" name="password" placeholder="Lascia vuoto per non cambiarla">
                </div>

                <button type="submit" class="submit-btn">Salva Modifiche</button>
            </form>
        </div>
    </div>
</body>
</html>