# gestione del database per la gestione di un sito di forum/post scolastici

CREATE DATABASE IF NOT EXISTS students_forum;
USE students_forum;

# tabella scuole che rappresenta le scuole che possono registrarsi al sito, con i loro dati di contatto 
# e una password per accedere al sito e gestire i propri post e commenti.
CREATE OR REPLACE TABLE scuole (
    scuola_id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    indirizzo VARCHAR(255) NOT NULL,
    citta VARCHAR(100) NOT NULL,
    provincia VARCHAR(100) NOT NULL,
    cap VARCHAR(10) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(20) NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);

# tabella che rappresenta gli utenti
# gli utenti sono diversi dalla scuola
CREATE OR REPLACE TABLE utenti (
    utente_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL UNIQUE,
    nome VARCHAR(100) NOT NULL,
    cognome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    descrizione TEXT,
    scuola_id INT,
    data_registrazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (scuola_id) REFERENCES scuole(scuola_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE OR REPLACE TABLE forum (
    forum_id INT PRIMARY KEY AUTO_INCREMENT,
    utente_id INT NOT NULL,
    titolo VARCHAR(255) NOT NULL,
    contenuto TEXT NOT NULL,
    data_pubblicazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utente_id) REFERENCES utenti(utente_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE OR REPLACE TABLE commenti (
    commento_id INT PRIMARY KEY AUTO_INCREMENT,
    forum_id INT NOT NULL,
    utente_id INT NOT NULL,
    contenuto TEXT NOT NULL,
    data_pubblicazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    commento_id_padre INT,
    FOREIGN KEY (commento_id_padre) REFERENCES commenti(commento_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (forum_id) REFERENCES forum(forum_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (utente_id) REFERENCES utenti(utente_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE OR REPLACE TABLE files (
    file_id INT PRIMARY KEY AUTO_INCREMENT,
    forum_id INT NOT NULL,
    nome_file VARCHAR(255) NOT NULL,
    percorso_file VARCHAR(255) NOT NULL,
    FOREIGN KEY (forum_id) REFERENCES forum(forum_id) ON DELETE CASCADE ON UPDATE CASCADE
);

