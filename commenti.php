<?php
require_once "function.php";

session_start();

// accesso negato se l'utennte non è registrato, lo mando a registrarsi
$email = $_SESSION['email'] ?? null;
$utente_id = $_SESSION['utente_id'] ?? null;
$scuola_id = $_SESSION['scuola_id'] ?? null;

if ($email === null) {
    header('Location: login.php');
    exit;
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
    // 1. Controllo di proprietà
    $puoEliminare = false;
    
    // Verifica se l'utente loggato è l'autore del commento (o la scuola corrispondente)
    if (($utente_id !== null && $commento['utente_id'] == $utente_id) || 
        ($scuola_id !== null && $commento['scuola_id'] == $scuola_id)) {
        $puoEliminare = true;
    }

    $tipoClasse = !empty($commento['scuola_id']) ? 'scuola-post' : 'utente-post';
    
    echo "
    <div class='card comment {$tipoClasse}'>
        <div class='comment-meta'>
            <strong>" . htmlspecialchars($commento['autore']) . "</strong> 
            " . (!empty($commento['scuola_id']) ? " <small>(Scuola)</small>" : "") . " 
            • {$commento['data_pubblicazione']}
            
            " . ($puoEliminare ? "
            <a href='elimina_commento.php?commento_id={$commento['commento_id']}&forum_id={$forum_id}' 
               class='delete-link' 
               onclick='return confirm(\"Sei sicuro di voler eliminare?\")'>Elimina</a>" : "") . "
        </div>
        <p>" . nl2br(htmlspecialchars($commento['contenuto'])) . "</p>
        </div>";
}

if(!$isLastPage) {
    echo "<button hx-get='commenti.php?forum_id={$forum_id}&nPagina=".($nPagina + 1)."' hx-swap='outerHTML'>Vedi altro</button>";
}
?>