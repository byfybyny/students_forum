


-- =====================
-- SCUOLE
-- =====================
INSERT INTO scuole (nome, indirizzo, citta, provincia, cap, email, telefono, password_hash) VALUES
('Liceo Scientifico Galileo Galilei', 'Via Roma 1', 'Milano', 'MI', '20100', 'info@galilei-mi.edu.it', '0212345678', '$2y$10$8/qySeKwrFXNrzKggTxRSeQ8ViijLoiLCeuibd9l6fsLOUA5ROgLK'),           #Galilei2024!
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
(1, 'Dubbio sui limiti — forma indeterminata 0/0', 'Non riesco a capire quando applicare De L''Hopital e quando invece conviene raccogliere. Qualcuno ha un metodo per riconoscere i casi?'),
(1, 'Come studiare meglio per gli esami?', NOW()),
(2, 'Migliori app per prendere appunti', NOW()),
(3, 'Consigli per la tesi di laurea', NOW()),
(4, 'Quale linguaggio di programmazione imparare prima?', NOW()),
(5, 'Come gestire lo stress universitario', NOW()),
(1, 'Libri consigliati per informatica', NOW()),
(2, 'Differenza tra Java e Python', NOW()),
(3, 'Come trovare uno stage in azienda', NOW()),
(4, 'Migliori risorse per imparare SQL', NOW()),
(5, 'Come funziona il machine learning?', NOW()),
(1, 'Consigli per imparare HTML e CSS', NOW()),
(2, 'Come fare una buona presentazione', NOW()),
(3, 'Differenza tra frontend e backend', NOW()),
(4, 'Come funziona git e github?', NOW()),
(5, 'Migliori framework per il web', NOW()),
(1, 'Come prepararsi per un colloquio tecnico', NOW()),
(2, 'Consigli per lavorare da remoto', NOW()),
(3, 'Come imparare JavaScript velocemente', NOW()),
(4, 'Differenza tra MySQL e PostgreSQL', NOW()),
(5, 'Come funziona il cloud computing?', NOW()),
(1, 'Migliori corsi online gratuiti', NOW()),
(2, 'Come costruire un portfolio professionale', NOW()),
(3, 'Consigli per imparare PHP', NOW()),
(4, 'Come funziona una API REST?', NOW()),
(5, 'Differenza tra HTTP e HTTPS', NOW()),
(1, 'Come ottimizzare un sito web', NOW()),
(2, 'Migliori editor di codice', NOW()),
(3, 'Come funziona Docker?', NOW()),
(4, 'Consigli per imparare React', NOW()),
(5, 'Come funziona il responsive design?', NOW()),
(1, 'Differenza tra SQL e NoSQL', NOW()),
(2, 'Come imparare la cybersecurity?', NOW()),
(3, 'Consigli per imparare Linux', NOW()),
(4, 'Come funziona un database relazionale?', NOW()),
(5, 'Migliori libri di matematica per informatici', NOW()),
(1, 'Come funziona la crittografia?', NOW()),
(2, 'Consigli per imparare C++', NOW()),
(3, 'Come funziona il protocollo TCP/IP?', NOW()),
(4, 'Differenza tra compiled e interpreted languages', NOW()),
(5, 'Come funziona un sistema operativo?', NOW()),
(1, 'Migliori podcast per sviluppatori', NOW()),
(2, 'Come funziona la memoria RAM?', NOW()),
(3, 'Consigli per imparare TypeScript', NOW()),
(4, 'Come funziona un algoritmo di ordinamento?', NOW()),
(5, 'Differenza tra stack e heap', NOW()),
(1, 'Come funziona il garbage collector?', NOW()),
(2, 'Consigli per imparare Vue.js', NOW()),
(3, 'Come funziona una rete neurale?', NOW()),
(4, 'Differenza tra processo e thread', NOW()),
(5, 'Come funziona il protocollo HTTP?', NOW());

insert into forum(utente_id, titolo, contenuto, data_pubblicazione)
values(4, 'Miglior Sistema Operativo', 'Ciao potete suggerirmi qual è il miglior sistema operativo per uno studente alle prime armi?', '2026-05-21 12:00:00');

INSERT INTO forum (utente_id, titolo, contenuto, data_pubblicazione)
VALUES
(2, 'Primo linguaggio di programmazione',
 'Ciao a tutti! Sono al primo anno di informatica e vorrei imparare a programmare. Quale linguaggio mi consigliate per cominciare? Ho sentito parlare di Python, Java e C++.',
 '2026-05-21 14:30:00'),

(5, 'Miglior editor di codice per principianti',
 'Salve! Sto iniziando a studiare programmazione e non so quale editor usare. Ho visto che esistono VS Code, Sublime Text e altri. Qual è il più adatto per chi è alle prime armi?',
 '2026-05-22 09:15:00'),

(1, 'Antivirus gratuito e affidabile',
 'Ciao a tutti, volevo chiedervi se conoscete un buon antivirus gratuito per Windows. Ne ho provati diversi ma non so quale sia veramente efficace. Avete esperienze da condividere?',
 '2026-05-22 16:45:00'),

(3, 'Miglior browser per non rallentare il PC',
 'Ho un portatile non molto potente e Chrome mi occupa troppa RAM. Conoscete un browser leggero ma completo? Sto valutando Firefox o Edge ma non so quale scegliere.',
 '2026-05-23 10:00:00'),

(4, 'Backup dei file: come farlo correttamente?',
 'Ciao! Ho perso dei file importanti per un guasto al disco e ora voglio imparare a fare backup in modo regolare. Quali strumenti o metodi usate voi? Cloud o disco esterno?',
 '2026-05-23 18:20:00');

-- =====================
-- COMMENTI
-- =====================
INSERT INTO commenti (forum_id, utente_id, contenuto, commento_id_padre) VALUES
-- Commenti al post 1 (equazioni differenziali)
(1, 3, 'Ciao Mario! Il metodo di separazione delle variabili funziona così: porti tutti i termini con y a sinistra e quelli con x a destra, poi integri entrambi i membri. Prova con dy/dx = x*y come esercizio base.', NULL),
-- Commenti al post 60 (Differenza tra HTTP e HTTPS)
(60, 2, 'HTTPS è sicuramente più sicuro di HTTP. La differenza principale è la crittografia dei dati!', NULL),
(60, 4, 'Esatto! HTTP trasmette i dati in chiaro, mentre HTTPS usa SSL/TLS per criptarli. Fondamentale per dati sensibili.', NULL),
(60, 1, 'Mi piace questa spiegazione. Ma qual è l''impatto sulla velocità del sito?', 2),
(60, 5, 'La velocità non dovrebbe essere un problema con i server moderni. HTTPS è oramai uno standard.', 3),
(60, 3, 'Concordo, anche Google predilige i siti HTTPS nei risultati di ricerca.', 4),
(60, 2, 'Vero! Un sito senza HTTPS viene segnalato come "non sicuro" nei browser moderni.', 5),
(60, 1, 'Ho letto che HTTPS2 è ancora più veloce di HTTPS. Qualcuno ha esperienze?', NULL),
(60, 4, 'Parli di HTTP/2, non HTTPS2. HTTP/2 è un protocollo di trasporto più efficiente, compatibile con HTTPS.', 6),
(60, 5, 'HTTP/2 riduce la latenza e permette il multiplexing. È perfetto per le applicazioni moderne!', 7),
(60, 3, 'Vi consiglio di controllare se il vostro hosting supporta HTTP/2. Fa veramente differenza!', 8),
(60, 1, 'Grazie per la chiarificazione! Dovrò aggiornare il mio sito web allora.', 7),
(60, 2, 'Per migrare ad HTTPS, potete usare Let''s Encrypt: offre certificati gratuiti e automatici.', NULL),
(60, 4, 'Let''s Encrypt è fantastico! Io l''ho usato per tutti i miei progetti. È semplicissimo da configurare.', 9),
(60, 5, 'Confermo, Let''s Encrypt è affidabile e gratuito. Niente scuse per non usare HTTPS!', 10),
(60, 3, 'Secondo me ogni sito, anche quelli piccoli, dovrebbe usare HTTPS per proteggere i visitatori.', 11),
(60, 1, 'C''è qualcuno che ha problemi con certificati self-signed?', NULL),
(60, 2, 'I certificati self-signed generano avvisi nei browser. Meglio usare Let''s Encrypt.', 12),
(60, 4, 'I self-signed vanno bene solo per ambiente di sviluppo locale, non per produzione.', 13),
(60, 5, 'Esatto, per produzione sempre certificati firmati da una CA riconosciuta.', 14),
(60, 3, 'Qual è la differenza tra TLS 1.2 e TLS 1.3?', NULL),
(60, 1, 'TLS 1.3 è più veloce e sicuro di TLS 1.2. Ha eliminato gli algoritmi obsoleti.', 15),
(60, 2, 'TLS 1.3 anche riduce il tempo di handshake, migliorando notevolmente le prestazioni.', 16),
(60, 4, 'Consiglio di disabilitare le versioni antiche di TLS per motivi di sicurezza.', 17),
(60, 5, 'SSLlabs.com ha un tool fantastico per testare la configurazione HTTPS del vostro sito!', NULL),
(60, 3, 'Grazie Sofia! Controllerò subito la configurazione del mio sito con quel tool.', 18),
(1, 5, 'Concordo con Luca. Ti consiglio anche di guardare i video di Khan Academy sulle ODE, sono molto chiari!', NULL),
(1, 1, 'Grazie mille! Il video di Khan Academy è stato illuminante, ora ci riprovo.', 2),  -- risposta al commento 2
(1, 2, 'Se vuoi, posso inviarti anche un esempio risolto passo passo per la prima equazione, fammi sapere.', NULL),
(1, 4, 'Grazie Sofia, quei passaggi sarebbero utilissimi a molti di noi.', 4),
(1, 5, 'Mi piacerebbe anche vedere il caso con coefficienti non costanti.', 4),
(1, 1, 'Ho provato anche con un sistema di equazioni a variabili separate e funziona lo stesso principio.', NULL),
(1, 3, 'Sì, sempre se riesci a isolare y e x: la pratica aiuta molto.', 7),
-- Commenti al post 2 (Python)
(2, 4, 'Io ho usato "Automate the Boring Stuff with Python", è gratuito online ed è perfetto per chi inizia!', NULL),
(2, 1, 'Anche i tutorial di W3Schools sono utili per la sintassi base, anche se per progetti seri meglio la documentazione ufficiale.', NULL),
(2, 3, 'Ottimo suggerimento Sofia! Aggiungerei anche i mini-progetti su Exercism per fare pratica.', 4),  -- risposta al commento di Sofia
(2, 2, 'Consiglio inoltre di fare piccoli progetti: una calcolatrice, un bot per Telegram, ecc.', NULL),
(2, 5, 'Hai ragione, iniziare con progetti concreti aiuta a capire davvero il linguaggio.', 10),
(2, 4, 'Io preferisco esplorare anche esercizi su Codewars subito dopo aver appreso le basi.', 10),
(2, 1, 'Per chi è alle prime armi, non sottovalutare la leggibilità del codice: usa nomi chiari.', NULL),
(2, 3, 'Sofia, la leggibilità è fondamentale. Inoltre usa i commenti per spiegare i passaggi.', 13),

-- Commenti al post 3 (Dante)
(3, 2, 'Ho aggiunto anche l''analisi delle anime del Canto III — Piccarda Donati è il personaggio chiave. Qualcuno vuole confrontare le versioni?', NULL),
(3, 5, 'Ottima analisi Giulia! Secondo me il tema della volontà è centrale in tutto il Paradiso, non solo nel Canto III.', NULL),
(3, 1, 'Interessante! Secondo me la figura di Beatrice nel Paradiso è legata al tema dell''amore divino.', NULL),
(3, 2, 'Esatto, Beatrice rappresenta la conoscenza che guida Dante verso Dio.', 17),
(3, 4, 'Non dimentichiamoci del ruolo della giustizia nella struttura della Commedia.', NULL),
(3, 5, 'La giustizia è sicuramente presente, ma qui credo sia più importante la grazia.', 19);

-- =====================
-- FILES
-- =====================
INSERT INTO files (forum_id, nome_file, percorso_file) VALUES
(1, 'appunti_equazioni_differenziali.pdf', '/uploads/forum_1/appunti_equazioni_differenziali.pdf'),
(3, 'analisi_paradiso_canto3.docx', '/uploads/forum_3/analisi_paradiso_canto3.docx'),
(4, 'risultati_fotosintesi.xlsx', '/uploads/forum_4/risultati_fotosintesi.xlsx'),
(4, 'foto_esperimento.jpg', '/uploads/forum_4/foto_esperimento.jpg'),
(2, 'risorse_python.pdf', '/uploads/forum_2/risorse_python.pdf');