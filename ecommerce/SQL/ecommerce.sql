CREATE DATABASE IF NOT EXISTS ecommerce;
USE ecommerce;

CREATE TABLE if NOT EXISTS Utenti(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Email VARCHAR(255) NOT NULL,
	password_utente VARCHAR(255) NOT NULL,
	tipo INT
);

CREATE TABLE if NOT EXISTS categorie(
	id INT AUTO_INCREMENT PRIMARY KEY,
	Nome VARCHAR(50)
);

CREATE TABLE if NOT EXISTS opzioni(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Nome VARCHAR(25),
	costo FLOAT
);

CREATE TABLE if NOT EXISTS Prodotti(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Nome VARCHAR(50),
	quantita INT,
	prezzo FLOAT,
	id_categoria INT,
	FOREIGN KEY (id_categoria) REFERENCES categorie (id) 
);

CREATE TABLE if NOT EXISTS opzioni_prodotti(
	id INT AUTO_INCREMENT PRIMARY KEY,
	id_opzione INT,
	id_prodotto INT,
	FOREIGN KEY (id_opzione) REFERENCES opzioni (id),
	FOREIGN KEY (id_prodotto) REFERENCES prodotti (id) 
);

CREATE TABLE if NOT EXISTS carrelli(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_utente INT,
	FOREIGN KEY (id_utente) REFERENCES utenti (id)
);

CREATE TABLE if NOT EXISTS carrello_opzioni(
	id INT AUTO_INCREMENT PRIMARY KEY,
	id_carrello INT,
	id_utente INT,
	id_opzione INT,
	FOREIGN KEY (id_carrello) REFERENCES carrelli (id),
	FOREIGN KEY (id_utente) REFERENCES utenti (id),
	FOREIGN KEY (id_opzione) REFERENCES opzioni_prodotti (id_opzione)
);

CREATE TABLE if NOT EXISTS ordini(
	id INT AUTO_INCREMENT PRIMARY KEY,
	Nome VARCHAR(50),
	prezzo FLOAT
);

CREATE TABLE if NOT EXISTS ordini_carrelli(
	id INT AUTO_INCREMENT PRIMARY KEY,
	id_ordine INT,
	id_carrello INT,
	FOREIGN KEY (id_ordine) REFERENCES ordini (id),
	FOREIGN KEY (id_carrello) REFERENCES carrelli (id)
);





