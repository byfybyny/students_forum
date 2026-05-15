<?php

require_once "function.php";

$forum_id = $_REQUEST['forum_id'] ?? null;
$nPagina = $_REQUEST['nPagina'] ?? 1;

$commenti = getCommentsFromForumId($forum_id, $nPagina, 10);


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

?>

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
if(!$isLastPage) {
?>
<tr>
    <td colspan="3" id="more<?=$commento['commento_id']?>">
        <button
            hx-get="commenti.php?forum_id=<?=$forum_id?>&nPagina=<?=($nPagina + 1)?>"
            hx-target="#more<?=$commento['commento_id']?>"
            hx-swap="outerHTML"> Vedi di più
        </button>
        <div id="replies_<?=$commento['commento_id']?>"></div>
    </td>
</tr>
<?php
}
?>