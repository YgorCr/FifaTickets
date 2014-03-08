--
-- Table structure for table local
--

DROP TABLE IF EXISTS local;

CREATE TABLE local (
  id INTEGER NOT NULL,
  nome varchar(30) NOT NULL,
  rua varchar(50) NOT NULL,
  bairro varchar(50) NOT NULL,
  capacidade INTEGER NOT NULL,
  PRIMARY KEY (id)
);

--
-- Table structure for table partida
--

DROP TABLE IF EXISTS partida;

CREATE TABLE partida (
  id INTEGER NOT NULL,
  tipo varchar(10) NOT NULL,
  data date NOT NULL,
  local_id INTEGER NOT NULL REFERENCES local (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  PRIMARY KEY (id),
  UNIQUE(local_id)
);

--
-- Table structure for table ingressos_classes
--

DROP TABLE IF EXISTS ingressos_classes;

CREATE TABLE ingressos_classes (
  id INTEGER NOT NULL,
  nome varchar(30) NOT NULL,
  total INTEGER NOT NULL,
  vendidos INTEGER NOT NULL,
  valor REAL NOT NULL,
  PRIMARY KEY (id)
);

--
-- Table structure for table comprador
--

DROP TABLE IF EXISTS comprador;

CREATE TABLE comprador (
  id INTEGER NOT NULL,
  nome varchar(20) NOT NULL,
  cpf_cod varchar(15) NOT NULL,
  telefone INTEGER NOT NULL,
  rua varchar(100) NOT NULL,
  bairro varchar(100) NOT NULL,
  complemento varchar(300) NOT NULL,
  PRIMARY KEY (id)
);

--
-- Table structure for table compra
--

DROP TABLE IF EXISTS compra;

CREATE TABLE compra (
  id INTEGER NOT NULL,
  data date DEFAULT CURRENT_DATE,
  forma_de_pagamento INTEGER DEFAULT NULL,
  comprador_id INTEGER NOT NULL REFERENCES comprador (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  PRIMARY KEY (id),
  UNIQUE (comprador_id)
);

--
-- Table structure for table ingresso
--

DROP TABLE IF EXISTS ingresso;

CREATE TABLE ingresso (
  id INTEGER NOT NULL,
  data date NOT NULL,
  ingresso_classe_id INTEGER NOT NULL,
  partida_id INTEGER NOT NULL REFERENCES partida (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ingressos_classes_id INTEGER NOT NULL REFERENCES ingressos_classes (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  compra_id INTEGER NOT NULL REFERENCES compra (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  PRIMARY KEY (id,partida_id,ingressos_classes_id,compra_id)
);