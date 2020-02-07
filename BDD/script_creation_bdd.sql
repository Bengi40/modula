#DROP DATABASE modula;

CREATE DATABASE IF NOT EXISTS modula;
use modula;

CREATE TABLE IF NOT EXISTS contacts (
	id INT(5) AUTO_INCREMENT PRIMARY KEY,
	nom VARCHAR(50) NOT NULL,
	prenom VARCHAR(50) NOT NULL,
	email VARCHAR(50) NOT NULL,
	message TEXT NOT NULL,
	RGPD BOOLEAN NOT NULL,
	date date NOT NULL,
	heure time NOT NULL,
	ip VARCHAR(15) NOT NULL
);

CREATE TABLE IF NOT EXISTS login (
	id INT(5) AUTO_INCREMENT PRIMARY KEY,
	login VARCHAR(20) NOT NULL,
	mdp VARCHAR(20) NOT NULL
);

INSERT INTO contacts
VALUES 
(1,"Gonzalez","Benjamin","gonzalez.benjamin47@gmail.com","Bonjour, votre produit est vraiment super !",true,'2020-01-31 21:39:33',"192.168.1.251"),
(2,"Jean","Claude","jc@gmail.com","Bonjour, j'adore ce que vous faites !!",true,'2020-01-31 21:39:37',"165.108.12.121"),
(3,"Bond","James","bj@gmail.com","So cute !",true,'2020-01-31 22:45:33',"65.18.1.21"),
(4,"Renault","Mégane","rm@gmail.com","Bonjour, j'adore ce que vous faites !!",true,'2020-02-01 10:25:33',"65.18.1.21"),
(5,"Jean","Claude","jc@gmail.com","Bonjour, j'adore ce que vous faites !!",true,'2020-02-01 21:39:33',"85.64.214.221");

INSERT INTO login
VALUES(1,"admin","admin");
