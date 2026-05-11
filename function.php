<?php

require_once "connessione_db.php";

/*
 * Funzione per ottenere i preferiti di un utente con paginazione
 * @param int $id_utente L'ID dell'utente
 * @param int $nPagina Il numero della pagina da visualizzare
 * @param int $dimensionePagina Il numero di preferiti da visualizzare per pagina
 * @return array Un array di preferiti per la pagina richiesta
 */
function getPreferiti($id_utente, $nPagina, $dimensionePagina) {
    global $pdo;

    $offset = ($nPagina - 1) * $dimensionePagina;

    $sql = "<<<SQL
        select f.titolo, f.data_pubblicazione, u.username
        from preferiti as p
        join forum as f on f.forum_id = p.forum_id
        join utenti as u on u.utenti_id = f.utente_id
        where p.utente_id = :id_utente
        limit :limit offset :offset
    SQL";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':id_utente', $id_utente, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $dimensionePagina, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll();
}

