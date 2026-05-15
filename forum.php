<?php

require_once "function.php";

// dati dell'utente
session_start();
$email = $_SESSION['email'] ?? null;
$tipo = $_SESSION['tipo'] ?? null;

if(!isset($email, $tipo)) {
    header('Location: login.php');
    exit;
}

// dati del forum
$forum_id = $_REQUEST['forum_id'] ?? null;
$forum = getForumByForumId($forum_id);

if ($forum_id === null || $forum === false) {
    if($tipo === 'scuola') {
        header('Location: homepage_scuola.php');
    } else {
        header('Location: homepage_utente.php');
    }
    exit;
}

//dati dei commenti
$nPagina = $_REQUEST['nPagina'] ?? 1;
$commenti = getCommentsFromForumId($forum_id, $nPagina, 10);

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

        <table>
            <tr>
                <th>contenuto</th>
                <th>crato da</th>
                <th>creato il</th>
            </tr>
            <?php
            foreach($commenti as $commento) {
                ?>
                <tr>
                    <td><?=$commento['contenuto']?></td>
                    <td><?=$commento['username']?></td>
                    <td><?=$commento['data_pubblicazione']?> alle <?=$commento['ora_pubblicazione']?></td>
                </tr>
                <?php
                if($commento['num_risposte'] > 0) {
                    ?>
                    <tr>
                        <td colspan="3" id="replies<?=$commento['commento_id']?>">
                            <button
                                hx-get="ottieni_risposte.php?commento_id=<?=$commento['commento_id']?>&nPagina=1"
                                hx-target="#replies<?=$commento['commento_id']?>"
                                hx-swap="outerHTML"> Vedi risposte
                            </button>
                            <div id="replies_<?=$commento['commento_id']?>"></div>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </body>
</html>


