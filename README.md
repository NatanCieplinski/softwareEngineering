# Software Engineering

### Info:

Repository del gruppo **GitPub** per l'esame di Software Engineering 2019 - 2020.

#### Membri del gruppo:

| Nome             | Matricola | Email                              |
| ---------------- | --------- | ---------------------------------- |
| Natan Cieplinski | 251818    | natan.cieplinski@student.univaq.it |
| Alessandro Lodi  | 253383    | alelod96@gmail.com                 |
| Patrizia Villani | 253382    | patrizia.vil@icloud.com            |

### Consegne:

-  **Milestone 1:** (5/12/2019) il file è chiamato *Milestone1*
-  **Deliverable1**: (21/12/2019) il file è chiamato *Deliverable1*
   Le modifiche rispetto al documento precedente sono state evidenziate per colore. In rosso le **cancellazioni** e in verde le *aggiunte**.
   Le API Documentation si possono trovare [qui](https://documenter.getpostman.com/view/5342440/SWEE2Fdz?version=latest )
-  **Deliverable2**: (18/01/2020) Ci sono stati dei ritardi nella creazione del nuovo documento ma sono state mappate le api con laravel presenti nella cartella src e modificate le API di postman disponibili [qui](https://documenter.getpostman.com/view/5342440/SWT5k2Eb?version=latest)

### Avviare il test
1. Spostarsi nella cartella src/laradock
2. cp env-example .env
3. docker-compose --build up mysql nginx phpmyadmin workspace
4. Aggiungere 127.0.0.1 softeng.test agli hosts
5. Spostarsi nella cartella src
6. cp .env.example .env
7. Modificare .env con:
     - DB_HOST=mysql
     - DB_DATABASE=default 
     - DB_USERNAME=root
     - DB_PASSWORD=root
8. docker exec -it laradock_workspace_1 bash
9. composer install
10. php artisan key:generate
11. php artisan migrate

#### Per PhpMyAdmin
Visitare softeng.test:8080
  - server: mysql
  - username: root
  - password: root