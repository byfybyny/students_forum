<?php
require_once "function.php";

session_start();

// accesso negato se l'utennte non è registrato
$email = $_SESSION['email'] ?? null;
if ($email === null) {
    die("Accesso negato");
}

// dati relativi a forum o commento
$forum_id = isset($_REQUEST['forum_id']) ? (int)$_REQUEST['forum_id'] : null;
$commento_id = isset($_REQUEST['commento_id']) ? (int)$_REQUEST['commento_id'] : null;
$nPagina = isset($_REQUEST['nPagina']) ? (int)$_REQUEST['nPagina'] : 1;

if($commento_id == null and $forum_id != null) {
    $commenti = getCommentsFromForumId($forum_id, $nPagina, 11);
}
else if($commento_id != null) {
    $commenti = getCommentsFromCommentId($commento_id, $nPagina, 11);
}
else {
    die("Parametri non validi");
}

// se non ci sono commenti, inizializziamo un array vuoto per evitare errori
$commenti = $commenti ?? [];

// controllo se è l'ultima pagina
$isLastPage = false;
if(count($commenti) !== 11){
    $isLastPage = true;
} else {
    array_pop($commenti);
}

foreach($commenti as $commento) {
    // Determiniamo se è una scuola per aggiungere una classe CSS specifica (opzionale)
    $tipoClasse = !empty($commento['scuola_id']) ? 'scuola-post' : 'utente-post';
    
    echo "
    <div class='card comment {$tipoClasse}'>
        <div class='comment-meta'>
            <strong>" . htmlspecialchars($commento['autore']) . "</strong> 
            " . (!empty($commento['scuola_id']) ? " <small>(Scuola)</small>" : "") . " 
            • {$commento['data_pubblicazione']}
        </div>
        <p>" . nl2br(htmlspecialchars($commento['contenuto'])) . "</p>
        <div id='replies{$commento['commento_id']}'>
            " . ($commento['num_risposte'] > 0 ? "
            <button hx-get='commenti.php?commento_id={$commento['commento_id']}' hx-target='#replies{$commento['commento_id']}'>
                Vedi {$commento['num_risposte']} risposte
            </button>" : "") . "
        </div>
    </div>";
}

if(!$isLastPage) {
    echo "<button hx-get='commenti.php?forum_id={$forum_id}&nPagina=".($nPagina + 1)."' hx-swap='outerHTML'>Vedi altro</button>";
}
?>