<?php

require_once "connessione_db.php";

/*
 * Funzione per ottenere i preferiti di un utente con paginazione
 * @param int $id_utente L'ID dell'utente
 * @param int $nPagina Il numero della pagina da visualizzare
 * @param int $dimensionePagina Il numero di preferiti da visualizzare per pagina
 * @return array Un array di preferiti per la pagina richiesta
 */
function getPreferiti(int $id_utente, int $nPagina, int $dimensionePagina) {
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

/*
 * Funzione per ottenere i dettagli di un forum
 * @param int $forum_id L'ID del forum da ottenere
 * @return array Un array con i dettagli del forum
 */
function getForum(int $forum_id){
    global $pdo;

    $sql = "<<<SQL
        select f.titolo, f.contenuto, f.data_pubblicazione, u.username, s.nome as nome_scuola, s.citta as citta_scuola
        from forum as f
        join utenti as u on f.utente_id = u.utente_id
        join scuole as s on u.scuola_id = s.scuola_id
        where f.forum_id = :forum_id;
    SQL";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':forum_id', $forum_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch();
}

/*
 * Funzione per ottenere i dettagli di una scuola
 * @param int $scuola_id L'ID della scuola da ottenere
 * @return array Un array con i dettagli della scuola
 */
function getScuola(int $scuola_id){
    global $pdo;

    $sql = "<<<SQL
        select s.nome, s.indirizzo, s.citta, s.provincia, s.cap, s.email, s.telefono
        from scuole as s
        where s.scuola_id = :scuola_id;
    SQL";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':scuola_id', $scuola_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch();
}   

/*
 * Funzione per verificare le credenziali di login
 * @param PDO $pdo L'istanza PDO per la connessione al database
 * @param string $id L'ID dell'utente o della scuola
 * @param string $password La password da verificare
 * @return string|null Restituisce 'scuola' se è una scuola, 'utente' se è un utente, o null se le credenziali non sono valide
 */
function checkPassword(string $id, string $password) {
    global $pdo;

    //cerca nella tabella "scuole"
    $stmt = $pdo->prepare("SELECT password_hash FROM scuole WHERE scuola_id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    if ($row && password_verify($password, $row['password_hash'])) {
        return 'scuola';
    }

    //cerca nella tabella "utenti"
    $stmt = $pdo->prepare("SELECT password_hash FROM utenti WHERE utente_id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    if ($row && password_verify($password, $row['password_hash'])) {
        return 'utente';
    }

    //Non trovato in nessuna tabella
    return false;
}