--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- Data for Name: administrador; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY administrador (id, nome, cpf_cod, senha) FROM stdin;
1	eu	12345678901	123
2	oi	123	202cb962ac59075b964b07152d234b70
\.


--
-- Name: administrador_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('administrador_id_seq', 1, false);


--
-- Data for Name: comprador; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY comprador (id, nome, cpf_cod, rua, complemento, bairro, senha, cidade, telefone, estado) FROM stdin;
2	igor	12345678901	dos bobos	221	bancarios	202cb962ac59075b964b07152d234b70	jp	3333333333	PB
\.


--
-- Data for Name: compra; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY compra (id, data, forma_de_pagamento, comprador_id) FROM stdin;
\.


--
-- Name: compra_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('compra_id_seq', 1, true);


--
-- Name: comprador_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('comprador_id_seq', 2, true);


--
-- Data for Name: local; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY local (id, nome, estado, cidade, rua, bairro, capacidade) FROM stdin;
4	Estádio Castelão	CE	Fortaleza	 Avenida Alberto Craveiro	Castelão	58704
5	Arena Amazônia	AM	Manaus	Manaus	Flores	42374
6	Arena Dunas	RN	Natal	Prudente de Morais	Lagoa Nova	42086
7	Arena Pernambuco	PE	Recife	Deus é Fiel	Penedo	42849
8	Arena Fonte Nova	BA	Salvador	Ladeira da Fonte das Pedras	Nazaré	55000
9	Estádio do Maracanã	RJ	Rio de Janeiro	Eurico Rabelo	Maracanã	73531
10	Arena de São Paulo	SP	São Paulo	São Jorge	Tatuapé	65807
\.


--
-- Data for Name: partida; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY partida (id, tipo, data, local_id, nome) FROM stdin;
3	Grupos	2014-06-14	4	Uruguai x Costa Rica
4	Grupos	2014-06-17	4	Brasil x México
5	Grupos	2014-06-14	5	Inglaterra x Itália
6	Grupos	2014-06-18	5	Camarões x Croácia
7	Grupos	2014-06-18	9	Espanha x Chile
8	Grupos	2014-06-12	10	Brasil x Croácia
9	Grupos	2014-06-20	7	Itália x Costa Rica
\.


--
-- Data for Name: ingressos_classes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ingressos_classes (id, nome, total, vendidos, valor, partida_id) FROM stdin;
\.


--
-- Data for Name: ingresso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ingresso (id, ingressos_classes_id, compra_id) FROM stdin;
\.


--
-- Name: ingresso_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ingresso_id_seq', 1, true);


--
-- Name: ingressos_classes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ingressos_classes_id_seq', 1, true);


--
-- Name: local_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('local_id_seq', 10, true);


--
-- Name: partida_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('partida_id_seq', 9, true);


--
-- PostgreSQL database dump complete
--

