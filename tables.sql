//cria o banco de dados crud_bd

CREATE DATABASE crud_bd DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

//cria a tabela adm_usuarios

CREATE TABLE adm_usuarios (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    senha VARCHAR(15) DEFAULT NULL,
    PRIMARY KEY(id)
);

//cria a tabela cadastros

CREATE TABLE cadastros (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    cpf VARCHAR(15) DEFAULT NULL,
    senha VARCHAR(15) DEFAULT NULL,
    PRIMARY KEY(id)
);

//inserir usuario adm para acessar o sistema

INSERT INTO `adm_usuarios`(`nome`, `email`, `senha`) VALUES ('administrador','adm@mail.com.br','abc1234');