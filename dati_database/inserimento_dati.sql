


-- =====================
-- SCUOLE
-- =====================
INSERT INTO scuole (nome, indirizzo, citta, provincia, cap, email, telefono, password_hash) VALUES
('Liceo Scientifico Galileo Galilei', 'Via Roma 1', 'Milano', 'MI', '20100', 'mario.rossi@studenti.it', '0212345678', '$2y$10$8/qySeKwrFXNrzKggTxRSeQ8ViijLoiLCeuibd9l6fsLOUA5ROgLK'),           #Galilei2024!
('Istituto Tecnico Leonardo da Vinci', 'Corso Italia 45', 'Roma', 'RM', '00100', 'segreteria@davinci-rm.edu.it', '0698765432', '$2y$10$tA6akF6kOVYA9qVMAKokkedEn9bFEmZlVyHFdESIjNBWDnaDR/tfS'), #DaVinci2024!
('Liceo Classico Dante Alighieri', 'Piazza Dante 3', 'Napoli', 'NA', '80100', 'admin@dante-na.edu.it', '0817654321', '$2y$10$F4sKv6KMIEYVUvSw5VuBxeiYqN.oquYCEXrrxKjJb1unJKTHYIKnq');           #Dante2024!

-- =====================
-- UTENTI
-- =====================
INSERT INTO utenti (username, nome, cognome, email, password_hash, descrizione, scuola_id) VALUES
('mario_rossi', 'Mario', 'Rossi', 'mario.rossi@studenti.it', '$2y$10$sj4kQRFkEunnXDW2gSREBe44YT4daP7g99v.cPmtVh82zTMhFueLC', 'Appassionato di matematica e fisica', 1),            #Mario2024!
('giulia_bianchi', 'Giulia', 'Bianchi', 'giulia.bianchi@studenti.it', '$2y$10$rxtKocjdaqIySo1br2GFQew6Lk83MDzi3w0NZZeEtuCk9nvKAGaEi', 'Amo la letteratura e la filosofia', 3),     #Giulia2024!
('luca_verdi', 'Luca', 'Verdi', 'luca.verdi@studenti.it', '$2y$10$MEnIluZL7M6nK9Kz/5Ywh.NxtpI50gaE8879cVRd2iNzUAW02vYkS', 'Sviluppatore in erba, appassionato di informatica', 2), #Luca2024!
('sofia_romano', 'Sofia', 'Romano', 'sofia.romano@studenti.it', '$2y$10$N03LP6dMQcZqQzLBxqpLLu1StAujcko0fBlIXqgWihVYHiW/KvlDO', NULL, 2),                                          #Sofia2024!
('andrea_ferrari', 'Andrea', 'Ferrari', 'andrea.ferrari@studenti.it', '$2y$10$SFHSaMJISCobtEcNBnu4SOL08tmuIsc/G0SR8gGh7vp7VZsmCWcqW', 'Studente di scienze, amo la biologia', 1);  #Andrea2024!

-- =====================
-- FORUM (post)
-- =====================
INSERT INTO forum (utente_id, titolo, contenuto) VALUES
(1, 'Come risolvere le equazioni differenziali?', 'Ciao a tutti! Sto studiando le equazioni differenziali del primo ordine e faccio fatica con il metodo di separazione delle variabili. Qualcuno può spiegarmi con un esempio pratico?'),
(3, 'Risorse per imparare Python', 'Volevo condividere con voi alcune risorse utili per imparare Python che ho trovato online. Quali usate voi? Io ho iniziato con la documentazione ufficiale ma è un po'' ostica per i principianti.'),
(2, 'Analisi del Paradiso di Dante — Canto III', 'Per chi sta preparando la verifica su Dante: ho fatto un''analisi del Canto III del Paradiso. Parliamone insieme, magari integriamo le nostre versioni!'),
(5, 'Esperimento sulla fotosintesi — risultati', 'Abbiamo fatto l''esperimento sulla fotosintesi in laboratorio. Posto i risultati: la foglia esposta alla luce ha prodotto il 40% di ossigeno in più rispetto a quella in ombra. Voi che risultati avete ottenuto?'),
(1, 'Dubbio sui limiti — forma indeterminata 0/0', 'Non riesco a capire quando applicare De L''Hopital e quando invece conviene raccogliere. Qualcuno ha un metodo per riconoscere i casi?');

-- =====================
-- COMMENTI
-- =====================
INSERT INTO commenti (forum_id, utente_id, contenuto, commento_id_padre) VALUES
-- Commenti al post 1 (equazioni differenziali)
(1, 3, 'Ciao Mario! Il metodo di separazione delle variabili funziona così: porti tutti i termini con y a sinistra e quelli con x a destra, poi integri entrambi i membri. Prova con dy/dx = x*y come esercizio base.', NULL),
(1, 5, 'Concordo con Luca. Ti consiglio anche di guardare i video di Khan Academy sulle ODE, sono molto chiari!', NULL),
(1, 1, 'Grazie mille! Il video di Khan Academy è stato illuminante, ora ci riprovo.', 2),  -- risposta al commento 2

-- Commenti al post 2 (Python)
(2, 4, 'Io ho usato "Automate the Boring Stuff with Python", è gratuito online ed è perfetto per chi inizia!', NULL),
(2, 1, 'Anche i tutorial di W3Schools sono utili per la sintassi base, anche se per progetti seri meglio la documentazione ufficiale.', NULL),
(2, 3, 'Ottimo suggerimento Sofia! Aggiungerei anche i mini-progetti su Exercism per fare pratica.', 4),  -- risposta al commento di Sofia

-- Commenti al post 3 (Dante)
(3, 2, 'Ho aggiunto anche l''analisi delle anime del Canto III — Piccarda Donati è il personaggio chiave. Qualcuno vuole confrontare le versioni?', NULL),
(3, 5, 'Ottima analisi Giulia! Secondo me il tema della volontà è centrale in tutto il Paradiso, non solo nel Canto III.', NULL);

-- =====================
-- FILES
-- =====================
INSERT INTO files (forum_id, nome_file, percorso_file) VALUES
(1, 'appunti_equazioni_differenziali.pdf', '/uploads/forum_1/appunti_equazioni_differenziali.pdf'),
(3, 'analisi_paradiso_canto3.docx', '/uploads/forum_3/analisi_paradiso_canto3.docx'),
(4, 'risultati_fotosintesi.xlsx', '/uploads/forum_4/risultati_fotosintesi.xlsx'),
(4, 'foto_esperimento.jpg', '/uploads/forum_4/foto_esperimento.jpg'),
(2, 'risorse_python.pdf', '/uploads/forum_2/risorse_python.pdf');