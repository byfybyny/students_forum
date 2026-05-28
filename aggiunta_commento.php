<?php
require_once "function.php";
session_start();

$utente_id = $_SESSION['utente_id'] ?? null;
$scuola_id = $_SESSION['scuola_id'] ?? null;

if($scuola_id === null && $utente_id === null) {
    header('Location: login.php');
    exit;
}

$contenuto = $_REQUEST['contenuto'] ?? null;

// 1. Cast forzato a intero
$forum_id = isset($_REQUEST['forum_id']) ? (int)$_REQUEST['forum_id'] : 0;
$commento_padre = !empty($_REQUEST['commento_padre']) && $_REQUEST['commento_padre'] !== "null" ? (int)$_REQUEST['commento_padre'] : null;

// 2. Recupero dal padre se necessario
if ($forum_id === 0 && $commento_padre !== null) {
    $forum_id = getForumIdFromCommentoId($commento_padre);
}

if(createCommento($utente_id, $scuola_id, $forum_id, $commento_padre, $contenuto)) {
    $nuovo_id = (int)$pdo->lastInsertId();
    $commento = getCommentoById($nuovo_id);
    
    // Logica per i pulsanti (deve essere identica a quella in commenti.php)
    $tipoClasse = !empty($commento['scuola_id']) ? 'scuola-post' : 'utente-post';
    $isAutore = ($utente_id !== null && $commento['utente_id'] == $utente_id) || 
                ($scuola_id !== null && $commento['scuola_id'] == $scuola_id);

    $pulsanteElimina = $isAutore ? "
        <form hx-post='elimina_commento.php' hx-target='closest .card' hx-swap='outerHTML transition:true' style='display:inline;'>
            <input type='hidden' name='commento_id' value='{$commento['commento_id']}'>
            <input type='hidden' name='forum_id' value='{$forum_id}'>
            <button type='submit' class='delete-link' onclick='return confirm(\"Eliminare?\")'>Elimina</button>
        </form>" : "";

    $pulsanteRispondi = "
        <div id='risposta_container_{$commento['commento_id']}'>
            <button hx-get='pagina_aggiunta_commento.php?forum_id={$forum_id}&commento_padre={$commento['commento_id']}' 
                    hx-target='#risposta_container_{$commento['commento_id']}'
                    hx-swap='outerHTML'>Rispondi</button>
        </div>";

    // Stampa del blocco HTML completo
    echo "
    <div class='card comment {$tipoClasse} new-comment'>
        <div class='comment-meta'>
            <strong>" . htmlspecialchars($commento['autore']) . "</strong> 
            " . (!empty($commento['scuola_id']) ? " <small>(Scuola)</small>" : "") . " 
            • Ora
            {$pulsanteElimina}
        </div>
        <p>" . nl2br(htmlspecialchars($commento['contenuto'])) . "</p>
        <div class='comment-actions'>
            {$pulsanteRispondi}
            <div id='replies{$commento['commento_id']}'></div>
        </div>
    </div>";
}