<?php
require_once "function.php";
 
session_start();
 
$email     = $_SESSION['email']     ?? null;
$utente_id = $_SESSION['utente_id'] ?? null;
$scuola_id = $_SESSION['scuola_id'] ?? null;
 
if ($email === null) {
    header('Location: login.php');
    exit;
}
 
$forum_id    = isset($_REQUEST['forum_id'])    ? (int)$_REQUEST['forum_id']    : null;
$commento_id = isset($_REQUEST['commento_id']) ? (int)$_REQUEST['commento_id'] : null;
$nPagina     = isset($_REQUEST['nPagina'])     ? (int)$_REQUEST['nPagina']     : 1;
 
if ($commento_id == null && $forum_id != null) {
    $commenti = getCommentsFromForumId($forum_id, $nPagina, 11);
} else if ($commento_id != null) {
    $commenti = getCommentsFromCommentId($commento_id, $nPagina, 11);
} else {
    die("Parametri non validi");
}
 
$commenti = $commenti ?? [];
 
$isLastPage = false;
if (count($commenti) !== 11) {
    $isLastPage = true;
} else {
    array_pop($commenti);
}
 
foreach ($commenti as $commento) {
    $tipoClasse = !empty($commento['scuola_id']) ? 'scuola-post' : 'utente-post';
    $isAutore   = ($utente_id !== null && $commento['utente_id'] == $utente_id) ||
                  ($scuola_id !== null && $commento['scuola_id'] == $scuola_id);
 
    $linkAutore = !empty($commento['scuola_id'])
        ? "<a href='profilo_scuola.php?scuola_id={$commento['scuola_id']}'><strong>" . htmlspecialchars($commento['autore']) . "</strong></a>"
        : "<a href='profilo_utente.php?utente_id={$commento['utente_id']}'><strong>" . htmlspecialchars($commento['autore']) . "</strong></a>";
 
    $pulsanteElimina = $isAutore ? "
    <form hx-post='elimina_commento.php'
        hx-target='closest .comment'
        hx-swap='outerHTML transition:true'
        hx-confirm='Sei sicuro di voler eliminare?'
        style='display:inline;'>
        <input type='hidden' name='commento_id' value='{$commento['commento_id']}'>
        <input type='hidden' name='forum_id' value='{$forum_id}'>
        <button type='submit' class='delete-link'>Elimina</button>
    </form>" : "";
 
    $pulsanteRispondi = "
        <div id='risposta_container_{$commento['commento_id']}'>
            <button hx-get='pagina_aggiunta_commento.php?forum_id={$forum_id}&commento_padre={$commento['commento_id']}'
                    hx-target='#risposta_container_{$commento['commento_id']}'
                    hx-swap='outerHTML'>
                Rispondi
            </button>
        </div>";
 
    $pulsanteVediRisposte = "
        <div id='replies{$commento['commento_id']}'>
            " . ($commento['num_risposte'] > 0 ? "
            <button hx-get='commenti.php?commento_id={$commento['commento_id']}'
                    hx-target='#replies{$commento['commento_id']}'>
                Vedi {$commento['num_risposte']} risposte
            </button>" : "") . "
        </div>";
 
    echo "
    <div class='card comment {$tipoClasse}'>
        <div class='comment-meta'>
            {$linkAutore}
            " . (!empty($commento['scuola_id']) ? "<small>(Scuola)</small>" : "") . "
            • {$commento['data_pubblicazione']}
            {$pulsanteElimina}
        </div>
        <p>" . nl2br(htmlspecialchars($commento['contenuto'])) . "</p>
        <div class='comment-actions'>
            {$pulsanteRispondi}
            {$pulsanteVediRisposte}
        </div>
    </div>";
}
 
if (!$isLastPage) {
    echo "<button hx-get='commenti.php?forum_id={$forum_id}&nPagina=" . ($nPagina + 1) . "' hx-swap='outerHTML'>Vedi altro</button>";
}
?>