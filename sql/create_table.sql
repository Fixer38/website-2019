create table client (
id int unsigned not null auto_increment primary key,
email varchar(64),
mdp varchar(255), 
nom varchar(20),
prenom varchar(20),
rue varchar(40),
localite varchar(40)
cp varchar(4),
num_maison varchar(3),
tel varchar(20),
last_connection date,
nb_connection int(1)
);
