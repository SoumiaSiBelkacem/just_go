CREATE DATABASE database_res;
USE database_res;
CREATE TABLE IF NOT EXISTS res (
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    message TEXT NOT NULL
);