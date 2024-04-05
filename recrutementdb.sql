START TRANSACTION;

CREATE DATABASE IF NOT EXISTS recrutementbd CHARACTER SET 'utf8';
CREATE USER IF NOT EXISTS societe_recrutement IDENTIFIED WITH mysql_native_password BY 'password';
GRANT ALL PRIVILEGES ON recrutementbd.* TO societe_recrutement;
USE recrutementbd;

CREATE TABLE IF NOT EXISTS cvs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(45),
    prenom VARCHAR(45),
    email VARCHAR(120),
    telephone VARCHAR(12),
    niveau_etude VARCHAR(45),
    fichier VARCHAR(150)
)
ENGINE=InnoDB;

COMMIT;
