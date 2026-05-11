<?php

require_once "connessione_db.php";

/*
 * Funzione per ottenere i preferiti di un utente con paginazione
 * @param int $id_utente L'ID dell'utente
 * @param int $nPagina Il numero della pagina da visualizzare
 * @param int $dimensionePagina Il numero di preferiti da visualizzare per pagina
 * @return array Un array di preferiti per la pagina richiesta
 */
function getPreferitiByUserId(int $id_utente, int $nPagina, int $dimensionePagina) {
    global $pdo;

    $offset = ($nPagina - 1) * $dimensionePagina;

    $sql = <<<SQL
        select f.forum_id, f.titolo, f.data_pubblicazione, u.utente_id, u.username
        from preferiti as p
        join forum as f on f.forum_id = p.forum_id
        join utenti as u on u.utente_id = f.utente_id
        where p.utente_id = :id_utente
        order by f.data_pubblicazione desc
        limit :limit offset :offset
    SQL;

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
function getForumByForumId(int $forum_id){
    global $pdo;

    $sql = <<<SQL
        select f.titolo, f.contenuto, f.data_pubblicazione, u.utente_id, u.username, s.scuola_id, s.nome as nome_scuola, s.citta as citta_scuola
        from forum as f
        join utenti as u on f.utente_id = u.utente_id
        join scuole as s on u.scuola_id = s.scuola_id
        where f.forum_id = :forum_id;
    SQL;

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
function getScuolaByScuolaId(int $scuola_id){
    global $pdo;

    $sql = <<<SQL
        select s.nome, s.indirizzo, s.citta, s.provincia, s.cap, s.email, s.telefono
        from scuole as s
        where s.scuola_id = :scuola_id;
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':scuola_id', $scuola_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch();
}   

/*
 * Funzione per ottenere i commenti di un forum
 * @param int $forum_id L'ID del forum di cui ottenere i commenti
 * @return array Un array di commenti associati al forum
 */
function getCommentiByForumId(int $forum_id){
    global $pdo;

    $sql = <<<SQL
        select c.contenuto, c.data_pubblicazione, c.commento_id_padre, u.utente_id, u.username
        from commenti as c
        join utenti as u on c.utente_id = u.utente_id
        where c.forum_id = :forum_id
        order by c.data_pubblicazione desc;
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':forum_id', $forum_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}

/*
 * Funzione per ottenere i dettagli di un utente
 * @param int $utente_id L'ID dell'utente da ottenere
 * @return array Un array con i dettagli dell'utente
 */
function getUtenteByUtenteId(int $utente_id){
    global $pdo;

    $sql = <<<SQL
        select u.username, u.nome, u.cognome, u.descrizione, s.scuola_id, s.nome as nome_scuola, s.citta as citta_scuola
        from utenti as u
        join scuole as s on u.scuola_id = s.scuola_id
        where u.utente_id = :utente_id;
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':utente_id', $utente_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch();

}

/*
 * Funzione per ottenere i file associati a un forum
 * @param int $forum_id L'ID del forum di cui ottenere i file
 * @return array Un array di file associati al forum
 */
function getFilesByForumId(int $forum_id) {
    global $pdo;

    $sql = <<<SQL
        select f.file_id, f.nome_file, f.percorso_file
        from files as f
        where f.forum_id = :forum_id;
        order by f.nome_file asc;
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':forum_id', $forum_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}

function createUtente(string $username, string $name, string $cognome, string $email, string $password){
    global $pdo;

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = <<<SQL
        insert into utenti (username, nome, cognome, email, password_hash)
        values (:username, :nome, :cognome, :email, :password_hash);
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':nome', $name, PDO::PARAM_STR);
    $stmt->bindValue(':cognome', $cognome, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

    return $stmt->execute();
}

/*
 * Funzione per verificare le credenziali di login
 * @param string $id L'ID dell'utente o della scuola
 * @param string $password La password da verificare
 * @return string|null Restituisce 'scuola' se è una scuola, 'utente' se è un utente, o null se le credenziali non sono valide
 */
function checkPassword(string $email, string $password): array|false {
    global $pdo;

    // Cerca in utenti per username
    $stmt = $pdo->prepare("SELECT email, nome, cognome, password_hash FROM utenti WHERE email = ?");
    $stmt->execute([$email]);
    $row = $stmt->fetch();

    if ($row && password_verify($password, $row['password_hash'])) {
        return [
            'email'   => $row['email'],
            'nome' => $row['nome'] . ' ' . $row['cognome'],
            'tipo' => 'utente'
        ];
    }

    // Cerca in scuole per email
    $stmt = $pdo->prepare("SELECT email, nome, password_hash FROM scuole WHERE email = ?");
    $stmt->execute([$email]);
    $row = $stmt->fetch();

    if ($row && password_verify($password, $row['password_hash'])) {
        return [
            'email'   => $row['email'],
            'nome' => $row['nome'],
            'tipo' => 'scuola'
        ];
    }

    return false;
}