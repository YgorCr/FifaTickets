--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.12
-- Dumped by pg_dump version 9.1.12
-- Started on 2014-03-11 00:06:32 BRT

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 167 (class 3079 OID 11699)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 1959 (class 0 OID 0)
-- Dependencies: 167
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 162 (class 1259 OID 17024)
-- Dependencies: 1824 6
-- Name: compra; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE compra (
    id integer NOT NULL,
    data date DEFAULT ('now'::text)::date,
    forma_de_pagamento integer,
    comprador_id integer NOT NULL
);


ALTER TABLE public.compra OWNER TO postgres;

--
-- TOC entry 163 (class 1259 OID 17028)
-- Dependencies: 1825 6
-- Name: comprador; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

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

--
-- TOC entry 1960 (class 0 OID 0)
-- Dependencies: 163
-- Name: COLUMN comprador.cidade; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN comprador.cidade IS ' ';


--
-- TOC entry 161 (class 1259 OID 17021)
-- Dependencies: 6
-- Name: ingresso; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ingresso (
    id integer NOT NULL,
    ingressos_classes_id integer NOT NULL,
    compra_id integer NOT NULL
);


ALTER TABLE public.ingresso OWNER TO postgres;

--
-- TOC entry 164 (class 1259 OID 17035)
-- Dependencies: 6
-- Name: ingressos_classes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ingressos_classes (
    id integer NOT NULL,
    nome character varying(30) NOT NULL,
    total integer NOT NULL,
    vendidos integer NOT NULL,
    valor real NOT NULL,
    partida_id integer NOT NULL
);


ALTER TABLE public.ingressos_classes OWNER TO postgres;

--
-- TOC entry 166 (class 1259 OID 17041)
-- Dependencies: 6
-- Name: local; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

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

--
-- TOC entry 165 (class 1259 OID 17038)
-- Dependencies: 6
-- Name: partida; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE partida (
    id integer NOT NULL,
    tipo character varying(10) NOT NULL,
    data date NOT NULL,
    local_id integer NOT NULL,
    nome character varying(100) NOT NULL
);


ALTER TABLE public.partida OWNER TO postgres;

--
-- TOC entry 1829 (class 2606 OID 17045)
-- Dependencies: 162 162 1953
-- Name: compra_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY compra
    ADD CONSTRAINT compra_pkey PRIMARY KEY (id);


--
-- TOC entry 1831 (class 2606 OID 17047)
-- Dependencies: 163 163 1953
-- Name: comprador_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY comprador
    ADD CONSTRAINT comprador_pkey PRIMARY KEY (id);


--
-- TOC entry 1827 (class 2606 OID 17049)
-- Dependencies: 161 161 1953
-- Name: ingresso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ingresso
    ADD CONSTRAINT ingresso_pkey PRIMARY KEY (id);


--
-- TOC entry 1833 (class 2606 OID 17053)
-- Dependencies: 164 164 1953
-- Name: ingressos_classes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ingressos_classes
    ADD CONSTRAINT ingressos_classes_pkey PRIMARY KEY (id);


--
-- TOC entry 1839 (class 2606 OID 17060)
-- Dependencies: 166 166 1953
-- Name: local_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY local
    ADD CONSTRAINT local_pkey PRIMARY KEY (id);


--
-- TOC entry 1835 (class 2606 OID 17062)
-- Dependencies: 165 165 1953
-- Name: partida_local_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY partida
    ADD CONSTRAINT partida_local_id_key UNIQUE (local_id);


--
-- TOC entry 1837 (class 2606 OID 17051)
-- Dependencies: 165 165 1953
-- Name: partida_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY partida
    ADD CONSTRAINT partida_pkey PRIMARY KEY (id);


--
-- TOC entry 1842 (class 2606 OID 17063)
-- Dependencies: 1830 162 163 1953
-- Name: compra_comprador_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY compra
    ADD CONSTRAINT compra_comprador_id_fkey FOREIGN KEY (comprador_id) REFERENCES comprador(id);


--
-- TOC entry 1840 (class 2606 OID 17068)
-- Dependencies: 161 1828 162 1953
-- Name: ingresso_compra_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ingresso
    ADD CONSTRAINT ingresso_compra_id_fkey FOREIGN KEY (compra_id) REFERENCES compra(id);


--
-- TOC entry 1841 (class 2606 OID 17073)
-- Dependencies: 1832 164 161 1953
-- Name: ingresso_ingressos_classes_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ingresso
    ADD CONSTRAINT ingresso_ingressos_classes_id_fkey FOREIGN KEY (ingressos_classes_id) REFERENCES ingressos_classes(id);


--
-- TOC entry 1843 (class 2606 OID 17054)
-- Dependencies: 164 1836 165 1953
-- Name: ingressos_classes_partida_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ingressos_classes
    ADD CONSTRAINT ingressos_classes_partida_id_fkey FOREIGN KEY (partida_id) REFERENCES partida(id);


--
-- TOC entry 1844 (class 2606 OID 17078)
-- Dependencies: 165 1838 166 1953
-- Name: partida_local_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY partida
    ADD CONSTRAINT partida_local_id_fkey FOREIGN KEY (local_id) REFERENCES local(id);


--
-- TOC entry 1958 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2014-03-11 00:06:32 BRT

--
-- PostgreSQL database dump complete
--

