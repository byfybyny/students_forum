<?php
    $forum_id = $_REQUEST['forum_id'] ?? null;
?>
<form action="aggiunta_commento.php?forum_id=<?=$forum_id?>" method="post" id ="aggiungi_commento">
    <textarea name="contenuto" required></textarea>
    <button type="submit">Aggiungi commento</button>
    <button type="button" id="annulla"
                hx-get="annulla_aggiunta_commento.php?forum_id=<?=$forum_id?>"
                hx-target="#aggiungi_commento"
                hx-trigger="click"
                hx-swap="outerHTML">Annulla</button>
</form>