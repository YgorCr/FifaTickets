-- PostgreSQL config
SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
SET search_path = public, pg_catalog;
SET default_tablespace = '';
SET default_with_oids = false;
REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Compra

CREATE TABLE compra (
    id integer NOT NULL,
    data date DEFAULT ('now'::text)::date,
    forma_de_pagamento integer,
    comprador_id integer NOT NULL
);

ALTER TABLE public.compra OWNER TO postgres;

ALTER TABLE ONLY compra
    ADD CONSTRAINT compra_pkey PRIMARY KEY (id);

ALTER TABLE ONLY compra
    ADD CONSTRAINT compra_comprador_id_fkey FOREIGN KEY (comprador_id) REFERENCES comprador(id) ON DELETE CASCADE;

CREATE SEQUENCE compra_id_seq
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
ALTER TABLE compra ALTER COLUMN id SET DEFAULT NEXTVAL('compra_id_seq'::regclass);



-- Comprador

CREATE TABLE comprador (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    cpf_cod character varying(15) NOT NULL,
    rua character varying(100) NOT NULL,
    complemento character varying(300),
    bairro character varying(20),
    senha character varying(32) DEFAULT 12345678901234567890123456789011::numeric NOT NULL,
    cidade character varying(20),
    telefone character varying(20),
    estado character varying(20)
);

ALTER TABLE public.comprador OWNER TO postgres;

CREATE SEQUENCE comprador_id_seq
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
ALTER TABLE comprador ALTER COLUMN id SET DEFAULT NEXTVAL('comprador_id_seq'::regclass);

ALTER TABLE ONLY comprador
    ADD CONSTRAINT comprador_pkey PRIMARY KEY (id);


ALTER TABLE ONLY comprador
    ADD CONSTRAINT comprador_cpf_cod_ukey UNIQUE (id);

COMMENT ON COLUMN comprador.cidade IS ' ';



-- Ingresso

CREATE TABLE ingresso (
    id integer NOT NULL,
    ingressos_classes_id integer NOT NULL,
    compra_id integer NOT NULL
);

ALTER TABLE public.ingresso OWNER TO postgres;

CREATE SEQUENCE ingresso_id_seq
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
ALTER TABLE ingresso ALTER COLUMN id SET DEFAULT NEXTVAL('ingresso_id_seq'::regclass);

ALTER TABLE ONLY ingresso
    ADD CONSTRAINT ingresso_pkey PRIMARY KEY (id);

ALTER TABLE ONLY ingresso
    ADD CONSTRAINT ingresso_compra_id_fkey FOREIGN KEY (compra_id) REFERENCES compra(id) ON DELETE CASCADE;

ALTER TABLE ONLY ingresso
    ADD CONSTRAINT ingresso_ingressos_classes_id_fkey FOREIGN KEY (ingressos_classes_id) REFERENCES ingressos_classes(id) ON DELETE CASCADE;



-- Ingressos Classes

CREATE TABLE ingressos_classes (
    id integer NOT NULL,
    nome character varying(30) NOT NULL,
    total integer NOT NULL,
    vendidos integer NOT NULL,
    valor real NOT NULL,
    partida_id integer NOT NULL
);

ALTER TABLE public.ingressos_classes OWNER TO postgres;

CREATE SEQUENCE ingressos_classes_id_seq
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
ALTER TABLE ingressos_classes ALTER COLUMN id SET DEFAULT NEXTVAL('ingressos_classes_id_seq'::regclass);

ALTER TABLE ONLY ingressos_classes
    ADD CONSTRAINT ingressos_classes_pkey PRIMARY KEY (id);

ALTER TABLE ONLY ingressos_classes
    ADD CONSTRAINT ingressos_classes_partida_id_fkey FOREIGN KEY (partida_id) REFERENCES partida(id) ON DELETE CASCADE;



-- Local

CREATE TABLE local (
    id integer NOT NULL,
    nome character varying(30) NOT NULL,
    estado character varying(30) NOT NULL,
    cidade character varying(30) NOT NULL,
    rua character varying(50) NOT NULL,
    bairro character varying(50) NOT NULL,
    capacidade integer NOT NULL
);

ALTER TABLE public.local OWNER TO postgres;

CREATE SEQUENCE local_id_seq
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
ALTER TABLE local ALTER COLUMN id SET DEFAULT NEXTVAL('local_id_seq'::regclass);

ALTER TABLE ONLY local
    ADD CONSTRAINT local_pkey PRIMARY KEY (id);



-- Partida

CREATE TABLE partida (
    id integer NOT NULL,
    tipo character varying(10) NOT NULL,
    data date NOT NULL,
    local_id integer NOT NULL,
    nome character varying(100) NOT NULL
);

ALTER TABLE public.partida OWNER TO postgres;

CREATE SEQUENCE partida_id_seq
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
ALTER TABLE partida ALTER COLUMN id SET DEFAULT NEXTVAL('partida_id_seq'::regclass);

ALTER TABLE ONLY partida
    ADD CONSTRAINT partida_pkey PRIMARY KEY (id);

ALTER TABLE ONLY partida
    ADD CONSTRAINT partida_local_id_fkey FOREIGN KEY (local_id) REFERENCES local(id) ON DELETE CASCADE;



-- Administrador

CREATE TABLE administrador (
    id integer NOT NULL,
    nome character varying(20) NOT NULL,
    cpf_cod character varying(13) NOT NULL,
    senha character varying(32) NOT NULL
);

ALTER TABLE public.administrador OWNER TO postgres;

ALTER TABLE ONLY administrador
    ADD CONSTRAINT administrador_pkey PRIMARY KEY (id);

CREATE SEQUENCE administrador_id_seq
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
ALTER TABLE administrador ALTER COLUMN id SET DEFAULT NEXTVAL('administrador_id_seq'::regclass);

