<?php

require_once "function.php";

// dati dell'utente
session_start();
$email = $_SESSION['email'] ?? null;

if($email === null) {
    header('Location: login.php');
    exit;
}

// dati del forum
$forum_id = $_REQUEST['forum_id'] ?? null;
$forum = getForumByForumId($forum_id);

if ($forum_id === null || $forum === false) {
    header('Location: login.php');
    exit;
}

//dati del file
$files = getFilesByForumId($forum_id);

?>

<!DOCTYPE html>
<html lang="it">
    <head></head></head>
        <title>Forum: <?=$forum['titolo']?></title>
        <script src="librerie/htmx.min.js"></script>
    </head>

    <body>
        <h1><?=$forum['titolo']?></h1>
        <h3>creato da <?=$forum['username']?> il <?=$forum['data_pubblicazione']?> alle <?=$forum['ora_pubblicazione']?></h3>
        <p><?=$forum['contenuto']?></p>

        <button id="aggiungi_commento"
                hx-get="pagina_aggiunta_commento.php?forum_id=<?=$forum_id?>"
                hx-target="#aggiungi_commento"
                hx-trigger="click"
                hx-swap="outerHTML">
                aggiungi commento</button>

        <table>
            <tr>
                <th>contenuto</th>
                <th>crato da</th>
                <th>creato il</th>
            </tr>
            <tr id=commenti>
                <td colspan="3">
                    <div
                        hx-get="commenti.php?forum_id=<?=$forum_id?>&nPagina=1"
                        hx-target="#commenti"
                        hx-trigger="revealed"
                        hx-swap="outerHTML">
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>


