<?php
    $forum_id = $_REQUEST['forum_id'] ?? null;
    $commento_padre = $_REQUEST['commento_padre'] ?? null;
    $id_container = ($commento_padre !== null) ? $commento_padre : 'pagina_aggiungi_commento';
?>
<div id="risposta_container_<?=$id_container?>">
    <form hx-post="aggiunta_commento.php" 
          hx-target="#risposta_container_<?=$id_container?>" 
          hx-swap="outerHTML" 
          class="comment-form-wrapper">
        
        <input type="hidden" name="forum_id" value="<?=$forum_id?>">
        <input type="hidden" name="commento_padre" value="<?=$commento_padre?>">
        
        <textarea name="contenuto" placeholder="Scrivi un commento..." required></textarea>
        
        <button type="submit">Pubblica</button>
        <button type="button" hx-get="annulla_aggiunta_commento.php?..." hx-target="#risposta_container_<?=$id_container?>">Annulla</button>
    </form>
</div>