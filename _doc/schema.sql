drop database if exists eleicoes;

create database eleicoes;

use eleicoes;

create table
  periodos (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(250) NOT NULL,
    data_inicio DATETIME NOT NULL,
    data_fim DATETIME NOT NULL,
    PRIMARY KEY (id)
  );

create table
  eleitores (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(250) NOT NULL,
    titulo INT NOT NULL,
    zona VARCHAR(250) NOT NULL,
    secao VARCHAR(250) NOT NULL,
    PRIMARY KEY (id)
  );

create table
  candidatos(
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(250) NOT NULL,
    partido VARCHAR(250) NOT NULL,
    numero INT NOT NULL,
    cargo VARCHAR(250) NOT NULL,
    periodo_id INT NOT NULL,
    FOREIGN KEY (periodo_id) REFERENCES periodos(id),
    PRIMARY KEY (id)
  );

create table
  votos (
    id INT NOT NULL AUTO_INCREMENT,
    data DATE NOT NULL,
    candidato_id INT NOT NULL,
    -- eleitor_id INT NOT NULL, /* entra em eleitores para pegar as informacoes de secao e zona */
    FOREIGN KEY (eleitor_id) REFERENCES eleitores(id),
    PRIMARY KEY (id)
  );
create table
  votantes (
    id INT NOT NULL AUTO_INCREMENT,
    eleitor_id INT NOT NULL,
    periodo_id INT NOT NULL,
    FOREIGN KEY (eleitor_id) REFERENCES eleitores(id),
    FOREIGN KEY (periodo_id) REFERENCES periodos(id),
    PRIMARY KEY (id)
  );
