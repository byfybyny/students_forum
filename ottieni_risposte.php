<?php

require_once "function.php";

$commento_id = $_REQUEST['commento_id'] ?? null;
$nPagina = $_REQUEST['nPagina'] ?? 1;

$commenti = getCommentsFromCommentId($commento_id, $nPagina, 10);
?>
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