CREATE DATABASE IF NOT EXISTS entregas;
USE entregas;

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL UNIQUE,
    senha VARCHAR(256) NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE entregas (
    id INT NOT NULL AUTO_INCREMENT,
    id_consumidor INT NOT NULL,
    id_entregador INT NULL,
    largura DECIMAL(10,2) NOT NULL,
    altura DECIMAL(10,2) NOT NULL,
    profundidade DECIMAL(10,2) NOT NULL,
    peso DECIMAL(10,2) NOT NULL,
    sensivel TINYINT(1) NOT NULL,
    status VARCHAR(20) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_consumidor) REFERENCES usuarios(id),
    FOREIGN KEY (id_entregador) REFERENCES usuarios(id)
);
