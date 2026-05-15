<?php

require_once "function.php";

$commento_id = $_REQUEST['commento_id'] ?? null;
$nPagina = $_REQUEST['nPagina'] ?? 1;

$commenti = getCommentsFromCommentId($commento_id, $nPagina, 10);


// controllo se è l'ultima pagina
$isLastPage = false;
if($commenti !== null){
    if(count($commenti) != 11){
        $isLastPage = true;
    }
    else {
        $lastElement = array_pop($commenti);
        if($lastElement === false){
            $isLastPage = true;
        }
    }
}

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
        <tr id="replies<?=$commento['commento_id']?>">
            <td colspan="3">
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
if(!$isLastPage) {
?>
<tr id="more<?=$commento['commento_id']?>">
    <td colspan="3">
        <button
            hx-get="commenti_risposte.php?commento_id=<?=$commento_id?>&nPagina=<?=($nPagina + 1)?>"
            hx-target="#more<?=$commento['commento_id']?>"
            hx-swap="outerHTML"> Vedi di più
        </button>
        <div id="replies_<?=$commento['commento_id']?>"></div>
    </td>
</tr>
<?php
}
?>