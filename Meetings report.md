# Meetings report

## Giovedì 26 Novembre 2019

Domande da fare al professore:

-  Aprire o chiudere una stanza: aprirla effettivamente o solo mostrare che è disponibile?
-  Definire la gerarchia di utenti
-  Possibile eliminazione del check in dato che c'è il controllo dell'occupazione del posto
-  Classificazione delle aule per livello di rumorosità
-  Possibilità di vedere dove hanno prenotato i tuoi amici. Un amico può visualizzare gli amici, e di conseguenza essere considerato personale abilitato?



Idee per la verifica della presenza in aula di uno studente:

-  Verifica tramite dispositivo di rete connesso al wifi universitario
-  Localizzazione 

Idee scartate:

-  Codice generato ogni tot da inserire
-  Tasto hardware sul banco
-  Badge universitario con scansione
-  Riconoscimento facciale
-  Bluetooth (necessarie troppe antenne per l'individuazione di ogni singolo studente)



Idee per la vista della disponibilità:

-  Selezionamento del singolo posto per orario per aula. 
-  Vista della mappa dell'università con aule, selezionamento del posto nell'aula



Idee per i professori:

-  I professori devono prenotare due giorni in anticipo rispetto alla data da prenotare
-  Gli studenti possono prenotare un solo giorno in anticipo, in modo che i professori possano prima occupare le aulee. 



Assumiamo che tutti gli utilizzatori abbiano un telefono con il GPS. L'utente deve avere un codice identificativo (mail universitaria)



## Incontro con il professore

-  Il software deve solo permettere di chiudere o aprire l'aula sul software, l'apertura fisica non è di nostro interesse

-  Non permettere di prenotare i singoli posti. Complessità inutile per il vantaggio. 

**Gerarchie di utenti:** 

1. Esclusività di alcune aule. 
2. Priorità per altre aule. Parametrizzare le tempistiche entro il quale il tipo di utente deve prenotare. 

Il sistema deve essere pensato anche per essere utilizzato per le lezioni a frequenza obbligatoria. 

E' possibile eliminare il check in in caso di controllo dell'occupazione del posto.

Cercare di ridurre al minimo l'hardware aggiuntivo da utilizzare.



## Domenica 1 Dicembre 2019
### Attori del sistema: 
- Studenti che vogliono prenotare un posto
- Professori che vogliono prenotare un aula
- Amministratori
- Sorvegliante in caso di problemi tra utenti
- Sistemi informatici universitari
  
### Scenari d'uso:
Nome: **Prenotazione aula da parte di uno studente**

Partecipanti: Studenti

Flusso di eventi:
- Lo studente apre l'app
- Lo studente vede quali aule hanno posti disponibili
- Lo studente decide il posto e lo prenota


Nome: **Check-in del aula da parte di uno studente**

Partecipanti: Studenti

Flusso di eventi:
- Lo studente entra in aula
- Lo studente apre l'app per fare il check in
- L'app genere un codice QR da far scansionare al dipositivo per il check in
- Il dispositivo scansiona il codice QR e invia i dati sullo studente al sistema
- Lo studente viene registrato come presente in aula
- 
Nome: **Annullamento di una prenotazione da parte di un professore**

Partecipanti: Professore

Flusso di eventi:
- Il professore apre l'app
- Il professore apre la sua lista di prenotazioni
- Lo professore decide la prenotazione da eliminare e la elimina
- Il sistema rende l'aula prenotata disponibile


Nome: **Annullamento di una prenotazione da parte di uno studente**

Partecipanti: Studenti

Flusso di eventi:
- Il studente apre l'app
- Lo studente apre la sua lista di prenotazioni
- Lo studente decide la prenotazione da eliminare e la elimina
- Il sistema rende il posto prenotato disponibile


Nome: **Prenotazione aula da parte di un professore**

Partecipanti: Professori, Studenti

Flusso di eventi:
- Il professore apre l'app
- Decide l'aula sulla mappa e la prenota
- Il sistema annulla le prenotazioni di tutti gli studenti che hanno prenotato per lo stesso orario e data
- Il sistema invia una notifica di annullamento delle prenotazioni a tutti gli studenti interessati


Nome: **Check-in aula da parte di un professore**

Partecipanti: Professori

Flusso di eventi:
- Il professore apre l'app
- Il professore conferma sull'app l'inizio della lezione 


Nome: **Segnalazione di "prenotazione falsa" da parte di un sorvegliante**

Partecipanti: Sorveglianti, Studenti

Flusso di eventi:
- Il sorvegliante apre l'app
- Trova il posto prenotato ma senza studenti e lo clicca
- Il sorvegliante clicca il pulsante "Segnala assenza"
- Il sistema invia una notifica di segnalazione allo studente che aveva prenotato
- Il sistema blocca l'utente dalle future prenotazioni se ha ricevuto 3 segnalazioni

Nome: **Segnalazione di "posto occupato" da parte di uno studente**

Partecipanti: Sorveglianti, Studenti

Flusso di eventi:
- Lo studente trova il suo posto occupato
- Lo studente apre l'app e effettua una segnalazione
- Il sorvegliante riceve una notifica con la segnalazione
- Il sorvegliante va in aula e caccia lo studente

Nome: **Apertura di un aula**

Partecipanti: Sorvegliante, Studenti

Flusso di eventi:
- Il sorvegliante apre le aule studio
- Il sorvegliante entra nell'applicazione, seleziona l'aula che ha aperto e la imposta come aperta
- Il sistema invia una notifica agli studenti che hanno acconsentito a riceverla

Nome: **Chiusura di un aula**

Partecipanti: Sorvegliante, Studenti

Flusso di eventi:
- Il sorvegliante chiude le aule studio
- Il sorvegliante entra nell'applicazione, seleziona l'aula che ha chiuso e la imposta come chiusa

Nome: **Accesso da parte di un utente**

Partecipanti: Studenti, Professori, Sorveglianti, Amministratori, Sistemi informatici universitari

Flusso di eventi:
- L'utente apre l'app
- L'utente seleziona l'università di appartenenza
- L'utente inserisce le credenziali che l'università gli ha fornito
- Il sistema comunica con il server dell'università selezionata dall'utente attraverso apposite API
- Il server dell'università comunica attraverso JSON se il login è andato a buon fine e i dati relativi all'utente, nonchè la tipologia di utenza (studente, professore, sorvegliante, amministratore)
- Il sistema logga l'utente in base alla sua tipologia
  

Nome: **Logout aula da parte di uno studente**

Partecipanti: Studenti

Flusso di eventi:
- Lo studente apre l'app
- Lo studente esegue il logout

Nome: **Logout aula da parte del professore**

Partecipanti: Professore

Flusso di eventi:
- Il professore apre l'app
- Il professore esegue il logout
  

Nome: **Controllo della disponibilità dell'aula**

Partecipanti: Sistemi informatici universitari, Studenti

Flusso di eventi:
- Il sistema richiede tramite una API al sistema informatico dell'università la disponibilità delle aule
- Il sistema aggiorna il proprio database
- Nel caso in cui un aula occupata ora risulti disponibile, il sistema la mostra come disponibile
- Nel caso in cui l'aula risulti non più disponibile il sistema annulla le prenotazioni di tutti gli studenti che hanno prenotato per lo stesso orario e data
- Nel caso precedente il sistema invia una notifica agli studenti che hanno acconsentito a riceverla

Nome: **Aggiunta/Aggiornamento della mappa da parte dell'amministratore**

Partecipanti: Amministratori

Flusso di eventi:
- L'amministratore apre il pannello di controllo
- L'amministratore seleziona la mappa o ne aggiunge una nuova
- L'amministratore carica un immagine della mappa
- L'amministratore clicca il pulsante salva
- Il sistema aggiorna il database
 
Nome: **Aggiunta/Aggiornamento delle aule nella mappa da parte dell'amministratore**

Partecipanti: Amministratori

Flusso di eventi:
- L'amministratore apre il pannello di controllo
- L'amministratore seleziona la mappa
- L'amministratore crea attraverso un apposito strumento l'area dell'aula sulla mappa o seleziona un'aula
- L'amministratore da un nome all'aula
- L'amministratore clicca il pulsante salva
- Il sistema aggiorna il database
 
Nome: **Configurazione delle aule nella mappa da parte dell'amministratore**

Partecipanti: Amministratori

Flusso di eventi:
- L'amministratore apre il pannello di controllo
- L'amministratore seleziona la mappa
- L'amministratore seleziona l'aula
- L'amministratore inserisce il numero di banchi presenti per ogni tipologia (banchi da 4, da 5, etc..)
- Il sistema crea automaticamente una mappa fittizzia dell'aula utilizzando le informazioni date dall'amministratore
- L'amministratore clicca il pulsante salva
- Il sistema aggiorna il database
- 
Nome: **Aggiunta/Aggiornamento delle tipologie di banchi da parte dell'amministratore**

Partecipanti: Amministratori

Flusso di eventi:
- L'amministratore apre il pannello di controllo
- L'amministratore seleziona tipologia dei banchi
- L'amministratore configura le varie tipologie di banchi con il numero di posti per ogni tipo
- L'amministratore clicca il pulsante salva
- Il sistema aggiorna il database

### Identificazione dei servizi
- Il sistema permette di effettuare il login con le credenziali della propria università
- Il sistema comunica con i sistemi già esistenti dell'università per ottenere i dati di identificazione dell'utente
- Il sistema permette di aggiungere una mappa dell'unviersità
- Il sistema permette di configurare la distribuzione dei posti all'interno di un'aula. La configurazione viene fatta specificando se i posti sono divisi in file o banchi, specificando il numero di file / banchi e specificando il numero di posti per file / banchi
- Il sistema permette di configurare le tipologie di banchi
- Il sistema effettua periodicamente un aggiornamento sullo stato delle aule disponibile in base al database delle lezioni dell'università
- Il sistema permette di aprire le aule
- Il sistema permette di chiudere le aule
- Il sistema permette di inviare segnalazioni al sorvegliante
- Il sistema permette al sorvegliante di segnalare gli utenti
- Il sistema permette di prenotare un posto in un aula
- Il sistema permette di prenotare un intera aula
- Il sistema permette di annullare la prenotazione di un posto
- Il sistema permette di annullare la prenotazione di un aula
- Il sistema permette di effettuare il check-in di un posto prenotato
- Il sistema permette di effettuare il check-in di un aula prenotata
- Il sistema permette di visualizzare le aule e i posti disponibili
- Il sistema permette di effettuare il check-out di un posto prenotato
- Il sistema permette di effettuare il check-out di un aula prenotata

## Lunedi 2 Dicembre 2019
### Excluded Requirements:
- Utilizzo del RFID per il check-in: il servizio avrebbe richiesto l'utilizzo di hardware apposito i cui vantaggi non avrebbero coperto  i costi
- Creazione di gruppi di studio: il servizio è risultato troppo macchinoso per l'utente finale e quindi non offre vantaggi
- Utilizzo del Wifi universitario per il check-in: il servizio avrebbe negato l'utilizzo del sistema agli utenti in diversi casi quindi è stato escluso 
- Visualizzazione dei posti disponibili in università come lista di aule: nel sondaggio condiviso con gli stakeholder, gli utente hanno indicato di non preferire questa opzione
- Controllo di un posto occupato a vuoto: il servizio avrebbe aumentato di troppo la complessità del sistema rispetto ai vantaggi che avrebbe offerto
- Segnalazione da parte di uno studente a una postazione occupata a vuoto: il servizio avrebbe potuto generare troppe segnalazioni delle quali non si poteva verificare l'autenticità. Avrebbe richiesto inoltre l'impego di troppo personale di controllo
- Utilizzo della posizione per il check in: il servizio poteva non essere sufficientemente preciso
- Utilizzo del bluetooth: il servizio sarebbe non potuto essere utilizzato da studenti che non avevano il bluetooth
- Caricamento di una mappa che rappresenti in modo realistico i posti dentro un'aula: la funzionalità avrebbe richiesto maggiore lavoro in fase di configurazione rispetto ad una mappa dei posti generata

### Requisiti non funzionali:
#### Usability
- **User error protection**: il sistema utilizza sistemi informatici  esterni per fornire dati sugli utenti, pertanto non è possibile avere dei dati errati nel sistema.
- **Learnability**: il sistema per gli utenti è utilizzabile tramite un sistema di "mappe". E' pertanto molto intuitivo da utilizzare. 
#### Security
- **Confidentiality**: Il sistema garantisce l'accesso alla visualizzazione delle prenotazioni solo al personale autorizzato
- **Accountability**: Il sistema prende i dati dal sistema informatico dell'università, la quale verifica le identità digitali utilizzando un documento di riconoscimento. L'identità si può quindi considerare univoca per ogni entità.
#### Maintainability
- **Reusability**: il sistema puù essere utilizzato come base per un sistema di registrazione delle presenze nelle lezioni a frequenza obbligatorie.
#### Portability
- **Adaptability**: Il sistema è pensato per essere utilizzato da più università tramite delle API. 

### Assunzioni:
- Assumiamo che lo studente/professore/sorvegliante abbia un telefono
- Assumiamo che lo studente sia iscritto all'università
- Assumiamo che il professore lavori nell'università
- Assumiamo che lo studente/professore/sorvegliante abbia internet o possa collegarsi al wi-fi dell'università
- Assumiamo che il sorvegliante sia reperibile durante le segnalazioni
- Assumiamo che ci sia una persona addetta alla costruzione delle mappe e che le costruisca correttamente
