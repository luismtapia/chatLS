--
-- PostgreSQL database dump
--

-- Dumped from database version 11.5 (Debian 11.5-1+deb10u1)
-- Dumped by pg_dump version 11.5 (Debian 11.5-1+deb10u1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: apartados; Type: TABLE; Schema: public; Owner: treze
--

CREATE TABLE public.apartados (
    id_apartado integer NOT NULL,
    nombre_cliente character varying(100),
    fecha_apartado date,
    fecha_vencimiento date,
    monto_total numeric,
    monto_abono numeric,
    monto_liquidar numeric
);


ALTER TABLE public.apartados OWNER TO treze;

--
-- Name: apartados_id_apartado_seq; Type: SEQUENCE; Schema: public; Owner: treze
--

CREATE SEQUENCE public.apartados_id_apartado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.apartados_id_apartado_seq OWNER TO treze;

--
-- Name: apartados_id_apartado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: treze
--

ALTER SEQUENCE public.apartados_id_apartado_seq OWNED BY public.apartados.id_apartado;


--
-- Name: categorias; Type: TABLE; Schema: public; Owner: treze
--

CREATE TABLE public.categorias (
    id_categoria integer NOT NULL,
    categoria character varying(100)
);


ALTER TABLE public.categorias OWNER TO treze;

--
-- Name: categorias_id_categoria_seq; Type: SEQUENCE; Schema: public; Owner: treze
--

CREATE SEQUENCE public.categorias_id_categoria_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.categorias_id_categoria_seq OWNER TO treze;

--
-- Name: categorias_id_categoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: treze
--

ALTER SEQUENCE public.categorias_id_categoria_seq OWNED BY public.categorias.id_categoria;


--
-- Name: productos; Type: TABLE; Schema: public; Owner: treze
--

CREATE TABLE public.productos (
    id_producto integer NOT NULL,
    producto character varying(100),
    descripcion character varying(200),
    marca character varying(50),
    cantidad integer,
    precio_compra numeric,
    precio_venta numeric,
    descuento numeric,
    fecha_captura date,
    id_usuario integer,
    id_categoria integer
);


ALTER TABLE public.productos OWNER TO treze;

--
-- Name: productos_apartados; Type: TABLE; Schema: public; Owner: treze
--

CREATE TABLE public.productos_apartados (
    id_apartado integer,
    id_producto integer,
    cantidad integer
);


ALTER TABLE public.productos_apartados OWNER TO treze;

--
-- Name: productos_id_producto_seq; Type: SEQUENCE; Schema: public; Owner: treze
--

CREATE SEQUENCE public.productos_id_producto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.productos_id_producto_seq OWNER TO treze;

--
-- Name: productos_id_producto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: treze
--

ALTER SEQUENCE public.productos_id_producto_seq OWNED BY public.productos.id_producto;


--
-- Name: tickets; Type: TABLE; Schema: public; Owner: treze
--

CREATE TABLE public.tickets (
    id_ticket integer NOT NULL,
    fecha date
);


ALTER TABLE public.tickets OWNER TO treze;

--
-- Name: tickets_id_ticket_seq; Type: SEQUENCE; Schema: public; Owner: treze
--

CREATE SEQUENCE public.tickets_id_ticket_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tickets_id_ticket_seq OWNER TO treze;

--
-- Name: tickets_id_ticket_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: treze
--

ALTER SEQUENCE public.tickets_id_ticket_seq OWNED BY public.tickets.id_ticket;


--
-- Name: tickets_productos; Type: TABLE; Schema: public; Owner: treze
--

CREATE TABLE public.tickets_productos (
    id_ticket integer,
    id_producto integer
);


ALTER TABLE public.tickets_productos OWNER TO treze;

--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: treze
--

CREATE TABLE public.usuarios (
    id_usuario integer NOT NULL,
    usuario character varying(50),
    email character varying(50),
    contrasena character varying(32)
);


ALTER TABLE public.usuarios OWNER TO treze;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: treze
--

CREATE SEQUENCE public.usuarios_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuarios_id_usuario_seq OWNER TO treze;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: treze
--

ALTER SEQUENCE public.usuarios_id_usuario_seq OWNED BY public.usuarios.id_usuario;


--
-- Name: apartados id_apartado; Type: DEFAULT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.apartados ALTER COLUMN id_apartado SET DEFAULT nextval('public.apartados_id_apartado_seq'::regclass);


--
-- Name: categorias id_categoria; Type: DEFAULT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.categorias ALTER COLUMN id_categoria SET DEFAULT nextval('public.categorias_id_categoria_seq'::regclass);


--
-- Name: productos id_producto; Type: DEFAULT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.productos ALTER COLUMN id_producto SET DEFAULT nextval('public.productos_id_producto_seq'::regclass);


--
-- Name: tickets id_ticket; Type: DEFAULT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.tickets ALTER COLUMN id_ticket SET DEFAULT nextval('public.tickets_id_ticket_seq'::regclass);


--
-- Name: usuarios id_usuario; Type: DEFAULT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuarios_id_usuario_seq'::regclass);


--
-- Data for Name: apartados; Type: TABLE DATA; Schema: public; Owner: treze
--

COPY public.apartados (id_apartado, nombre_cliente, fecha_apartado, fecha_vencimiento, monto_total, monto_abono, monto_liquidar) FROM stdin;
\.


--
-- Data for Name: categorias; Type: TABLE DATA; Schema: public; Owner: treze
--

COPY public.categorias (id_categoria, categoria) FROM stdin;
\.


--
-- Data for Name: productos; Type: TABLE DATA; Schema: public; Owner: treze
--

COPY public.productos (id_producto, producto, descripcion, marca, cantidad, precio_compra, precio_venta, descuento, fecha_captura, id_usuario, id_categoria) FROM stdin;
\.


--
-- Data for Name: productos_apartados; Type: TABLE DATA; Schema: public; Owner: treze
--

COPY public.productos_apartados (id_apartado, id_producto, cantidad) FROM stdin;
\.


--
-- Data for Name: tickets; Type: TABLE DATA; Schema: public; Owner: treze
--

COPY public.tickets (id_ticket, fecha) FROM stdin;
\.


--
-- Data for Name: tickets_productos; Type: TABLE DATA; Schema: public; Owner: treze
--

COPY public.tickets_productos (id_ticket, id_producto) FROM stdin;
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: treze
--

COPY public.usuarios (id_usuario, usuario, email, contrasena) FROM stdin;
\.


--
-- Name: apartados_id_apartado_seq; Type: SEQUENCE SET; Schema: public; Owner: treze
--

SELECT pg_catalog.setval('public.apartados_id_apartado_seq', 1, false);


--
-- Name: categorias_id_categoria_seq; Type: SEQUENCE SET; Schema: public; Owner: treze
--

SELECT pg_catalog.setval('public.categorias_id_categoria_seq', 1, false);


--
-- Name: productos_id_producto_seq; Type: SEQUENCE SET; Schema: public; Owner: treze
--

SELECT pg_catalog.setval('public.productos_id_producto_seq', 1, false);


--
-- Name: tickets_id_ticket_seq; Type: SEQUENCE SET; Schema: public; Owner: treze
--

SELECT pg_catalog.setval('public.tickets_id_ticket_seq', 1, false);


--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: treze
--

SELECT pg_catalog.setval('public.usuarios_id_usuario_seq', 1, false);


--
-- Name: apartados apartados_pkey; Type: CONSTRAINT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.apartados
    ADD CONSTRAINT apartados_pkey PRIMARY KEY (id_apartado);


--
-- Name: categorias categorias_pkey; Type: CONSTRAINT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.categorias
    ADD CONSTRAINT categorias_pkey PRIMARY KEY (id_categoria);


--
-- Name: usuarios emailuq1; Type: CONSTRAINT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT emailuq1 UNIQUE (email);


--
-- Name: productos productos_pkey; Type: CONSTRAINT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.productos
    ADD CONSTRAINT productos_pkey PRIMARY KEY (id_producto);


--
-- Name: tickets tickets_pkey; Type: CONSTRAINT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.tickets
    ADD CONSTRAINT tickets_pkey PRIMARY KEY (id_ticket);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);


--
-- Name: productos_apartados id_apartadofk1; Type: FK CONSTRAINT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.productos_apartados
    ADD CONSTRAINT id_apartadofk1 FOREIGN KEY (id_apartado) REFERENCES public.apartados(id_apartado);


--
-- Name: productos id_categoriafk2; Type: FK CONSTRAINT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.productos
    ADD CONSTRAINT id_categoriafk2 FOREIGN KEY (id_categoria) REFERENCES public.categorias(id_categoria);


--
-- Name: productos_apartados id_productofk2; Type: FK CONSTRAINT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.productos_apartados
    ADD CONSTRAINT id_productofk2 FOREIGN KEY (id_producto) REFERENCES public.productos(id_producto);


--
-- Name: tickets_productos id_productofk3; Type: FK CONSTRAINT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.tickets_productos
    ADD CONSTRAINT id_productofk3 FOREIGN KEY (id_producto) REFERENCES public.productos(id_producto);


--
-- Name: tickets_productos id_ticketfk1; Type: FK CONSTRAINT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.tickets_productos
    ADD CONSTRAINT id_ticketfk1 FOREIGN KEY (id_ticket) REFERENCES public.tickets(id_ticket);


--
-- Name: productos id_usuariofk1; Type: FK CONSTRAINT; Schema: public; Owner: treze
--

ALTER TABLE ONLY public.productos
    ADD CONSTRAINT id_usuariofk1 FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id_usuario);


--
-- PostgreSQL database dump complete
--

