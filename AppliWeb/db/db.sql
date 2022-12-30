

DROP DATABASE IF EXISTS heatmap;

CREATE DATABASE heatmap;

-- Create dedicated account for the heatmap database, so we don't need to rely on other root/admin accounts
CREATE USER 'heatmap'@'localhost' IDENTIFIED BY 'heatmap';
GRANT EXECUTE, PROCESS, SELECT, SHOW DATABASES, SHOW VIEW, ALTER, ALTER ROUTINE, CREATE, CREATE ROUTINE, CREATE TABLESPACE, CREATE TEMPORARY TABLES, CREATE VIEW, DELETE, DROP, EVENT, INDEX, INSERT, REFERENCES, TRIGGER, UPDATE, CREATE USER, FILE, LOCK TABLES, RELOAD, REPLICATION CLIENT, REPLICATION SLAVE, SHUTDOWN, SUPER  ON *.* TO 'heatmap'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;

USE heatmap;

CREATE TABLE countryScore(
    countryId INT NOT NULL AUTO_INCREMENT,
    countryTAG VARCHAR(9),
    countryNAME VARCHAR(255),
    score INT,
    
    PRIMARY KEY(countryId)
);

INSERT INTO countryScore(countryTAG, countryNAME, score) VALUES ("CHL","Chile",5);
INSERT INTO countryScore(countryTAG, countryNAME, score) VALUES ("PER","Peru",2);
INSERT INTO countryScore(countryTAG, countryNAME, score) VALUES ("BOL","Bolivia",1);
INSERT INTO countryScore(countryTAG, countryNAME, score) VALUES ("ARG","Argentina",4);
INSERT INTO countryScore(countryTAG, countryNAME, score) VALUES ("SUR","Suriname",6);
INSERT INTO countryScore(countryTAG, countryNAME, score) VALUES ("GUY","Guyana",8);
INSERT INTO countryScore(countryTAG, countryNAME, score) VALUES ("BRA","Brazil",8);
INSERT INTO countryScore(countryTAG, countryNAME, score) VALUES ("URY","Uruguay",5);
INSERT INTO countryScore(countryTAG, countryNAME, score) VALUES ("ECU","Ecuador",3);
INSERT INTO countryScore(countryTAG, countryNAME, score) VALUES ("COL","Colombia",3);
INSERT INTO countryScore(countryTAG, countryNAME, score) VALUES ("PRY","Brazil",1);
INSERT INTO countryScore(countryTAG, countryNAME, score) VALUES ("VEN","Venezuela",2);
INSERT INTO countryScore(countryTAG, countryNAME, score) VALUES ("FLK","Falkland Islands",1);