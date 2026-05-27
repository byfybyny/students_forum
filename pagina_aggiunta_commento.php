<?php
    $forum_id = $_REQUEST['forum_id'] ?? null;
    $commento_padre = $_REQUEST['commento_padre'] ?? null;
?>
<form action="aggiunta_commento.php?forum_id=<?=$forum_id?>&commento_padre=<?=$commento_padre?>" 
      method="post" 
      id="aggiungi_commento<?=$commento_padre?>" 
      onclick="event.stopPropagation();">
    
    <textarea name="contenuto" required onclick="event.stopPropagation();"></textarea>
    
    <button type="submit">Aggiungi commento</button>
    
    <button type="button" id="annulla"
            hx-get="annulla_aggiunta_commento.php?forum_id=<?=$forum_id?>&commento_padre=<?=$commento_padre?>"
            hx-target="#aggiungi_commento<?=$commento_padre?>"
            hx-trigger="click"
            hx-swap="outerHTML"
            onclick="event.stopPropagation();">Annulla</button>
</form>