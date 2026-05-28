<?php
    $forum_id = $_REQUEST['forum_id'] ?? null;
    $commento_padre = $_REQUEST['commento_padre'] ?? null;
    // Se è una risposta, il target è il div delle risposte del padre, altrimenti la lista generale
    $target = $commento_padre ? "#replies{$commento_padre}" : "#lista_commenti";
?>
<form hx-post="aggiunta_commento.php" 
      hx-target="<?=$target?>" 
      hx-swap="beforeend transition:true" 
      id="aggiungi_commento<?=$commento_padre?>" 
      class="comment-form-wrapper">
    
    <input type="hidden" name="forum_id" value="<?=$forum_id?>">
    <input type="hidden" name="commento_padre" value="<?=$commento_padre?>">
    
    <textarea name="contenuto" placeholder="Cosa ne pensi?" required></textarea>
    
    <div class="form-actions">
        <button type="button" class="btn-secondary"
                hx-get="annulla_aggiunta_commento.php?forum_id=<?=$forum_id?>&commento_padre=<?=$commento_padre?>"
                hx-target="#aggiungi_commento<?=$commento_padre?>"
                hx-swap="outerHTML">Annulla</button>
        <button type="submit">Pubblica</button>
    </div>
</form>