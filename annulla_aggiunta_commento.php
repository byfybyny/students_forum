<?php
    $forum_id = $_REQUEST['forum_id'] ?? null;
?>
<button id="aggiungi_commento"
                hx-get="pagina_aggiunta_commento.php?forum_id=<?=$forum_id?>"
                hx-target="#aggiungi_commento"
                hx-trigger="click"
                hx-swap="outerHTML">
                aggiungi commento</button>