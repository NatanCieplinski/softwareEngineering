# Software Engineering


### Info:
Prototype for the exam "Software Engineering" 2019 - 2020. 
#### Specification:
Given a library, study rooms or work rooms, the software must allow
to users (students, teachers, or various staff) to be able to get to know their
real-time availability. The user must be able to know, which
rooms are open for study / work and which ones have available seats.
The software must allow, among other things, to:
- open or close a study / work room / classroom;
- know the availability of each room / classroom;
- book (for a limited time) a classroom or a seat;
- check-in to the room;
- record the identity of those inside the classroom;
- prevent users from blocking study / work stations when not present;
- have a geo-localized view of the available classrooms;

Where possible, the software should minimize data entry by integrating with
existing applications. The application must be independent of a specification
University.

The application must be able to manage various rooms in various buildings within one
cities (up to 1000 rooms in 100 different buildings), with flows also equal to
hundreds of users per room. The application must not in any way
allow unauthorized personnel to get hold of information
on the identity of those who are currently in a study room.
#### Tech stack:
The project has been built using **Laravel** on the backend and **Vue** for the frontend. **MySQL** is the DBMS of choice. The prorotype is containerized using **Docker**.
#### Contributors:
Name of the group: **GitPub**

| Nome             | Matricola | Email                              |
| ---------------- | --------- | ---------------------------------- |
| Natan Cieplinski | 251818    | natan.cieplinski@student.univaq.it |
| Alessandro Lodi  | 253383    | alelod96@gmail.com                 |
| Patrizia Villani | 253382    | patrizia.vil@icloud.com            |



### API Postman Documentation

Api documentation can be found at [this](https://documenter.getpostman.com/view/5342440/SWTD8x88?version=latest) link.



### Demo

Here are some quick demo video of the prototype.

#### Login:

![prova](https://media.giphy.com/media/J4CK3AkbdfPi0S4vHY/source.gif)

#### Seats availability per time slots:

![](https://media.giphy.com/media/Xfy82LB9IPNaioSMJQ/source.gif)

#### Seat booking:

![](https://media.giphy.com/media/XyJVElSxeruTcrUH2z/source.gif)

#### Deletion of a reservation:

![](https://media.giphy.com/media/ehJVt0QQ1KJ1s531hz/source.gif)

