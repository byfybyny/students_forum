<?php
    $forum_id = $_REQUEST['forum_id'] ?? null;
    $commento_padre = $_REQUEST['commento_padre'] ?? null;
?>
<button id="aggiungi_commento<?=$commento_padre?>"
                hx-get="pagina_aggiunta_commento.php?forum_id=<?=$forum_id?>&commento_padre=<?=$commento_padre?>"
                hx-target="#aggiungi_commento<?=$commento_padre?>"
                hx-trigger="click"
                hx-swap="outerHTML">
                aggiungi commento</button>