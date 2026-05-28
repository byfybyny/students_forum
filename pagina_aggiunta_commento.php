<?php
    $forum_id = $_REQUEST['forum_id'] ?? null;
    $commento_padre = $_REQUEST['commento_padre'] ?? null;
?>
<form action="aggiunta_commento.php?forum_id=<?=$forum_id?>&commento_padre=<?=$commento_padre?>" 
      method="post" 
      id="aggiungi_commento<?=$commento_padre?>"
      class="comment-form-wrapper">
    
    <textarea name="contenuto" placeholder="Cosa ne pensi?" required></textarea>
    
    <div class="form-actions">
        <button type="button" class="btn-secondary"
                hx-get="annulla_aggiunta_commento.php?forum_id=<?=$forum_id?>&commento_padre=<?=$commento_padre?>"
                hx-target="#aggiungi_commento<?=$commento_padre?>"
                hx-swap="outerHTML">
            Annulla
        </button>
        
        <button type="submit">Pubblica</button>
    </div>
</form>