<?php

require_once "function.php";

$forum_id = $_REQUEST['forum_id'] ?? null;
$commento_id = $_REQUEST['commento_id'] ?? null;
$nPagina = $_REQUEST['nPagina'] ?? 1;

if($commento_id == null){
    $commenti = getCommentsFromForumId($forum_id, $nPagina, 11);
}
else{
    $commenti = getCommentsFromCommentId($commento_id, $nPagina, 11);
}




// controllo se è l'ultima pagina
$isLastPage = false;
if($commenti !== null){
    if(count($commenti) !== 11){
        $isLastPage = true;
    }
    else {
        $lastElement = array_pop($commenti);
        if($lastElement === false){
            $isLastPage = true;
        }
    }
}

if ($commenti !== null) {
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
                        hx-get="commenti.php?commento_id=<?=$commento['commento_id']?>"
                        hx-target="#replies<?=$commento['commento_id']?>"
                        hx-swap="outerHTML"> Vedi risposte
                    </button>
                </td>
            </tr>
            <?php
        }
    }
}

if(!$isLastPage) {
?>
<tr id="more<?=$forum_id?><?=$commento_id?>">
    <td colspan="3">
        <button
            hx-get="commenti.php?forum_id=<?=$forum_id?>&commento_id=<?=$commento_id?>&nPagina=<?=($nPagina + 1)?>"
            hx-target="#more<?=$forum_id?><?=$commento_id?>"
            hx-swap="outerHTML"> Vedi di più
        </button>
    </td>
</tr>
<?php
}
?>