
CREATE DATABASE bulletin_board CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE bulletin_board;

CREATE TABLE user (
    num INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    id VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL 
);