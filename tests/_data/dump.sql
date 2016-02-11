--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: bookmark_categories; Type: TABLE; Schema: public; Owner: homestead; Tablespace: 
--

CREATE TABLE bookmark_categories (
    bookmark_id integer NOT NULL,
    category_id integer NOT NULL
);


ALTER TABLE bookmark_categories OWNER TO homestead;

--
-- Name: bookmarks; Type: TABLE; Schema: public; Owner: homestead; Tablespace: 
--

CREATE TABLE bookmarks (
    id integer NOT NULL,
    user_id integer NOT NULL,
    name character varying(255) NOT NULL,
    url character varying(255) NOT NULL,
    description text NOT NULL,
    image_url character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE bookmarks OWNER TO homestead;

--
-- Name: bookmarks_id_seq; Type: SEQUENCE; Schema: public; Owner: homestead
--

CREATE SEQUENCE bookmarks_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE bookmarks_id_seq OWNER TO homestead;

--
-- Name: bookmarks_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: homestead
--

ALTER SEQUENCE bookmarks_id_seq OWNED BY bookmarks.id;


--
-- Name: categories; Type: TABLE; Schema: public; Owner: homestead; Tablespace: 
--

CREATE TABLE categories (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    description text NOT NULL,
    user_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE categories OWNER TO homestead;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: homestead
--

CREATE SEQUENCE categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE categories_id_seq OWNER TO homestead;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: homestead
--

ALTER SEQUENCE categories_id_seq OWNED BY categories.id;


--
-- Name: group; Type: TABLE; Schema: public; Owner: homestead; Tablespace: 
--

CREATE TABLE "group" (
    id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    name character varying(255) NOT NULL,
    description text DEFAULT 'This group has no description yet.'::text NOT NULL
);


ALTER TABLE "group" OWNER TO homestead;

--
-- Name: group_id_seq; Type: SEQUENCE; Schema: public; Owner: homestead
--

CREATE SEQUENCE group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE group_id_seq OWNER TO homestead;

--
-- Name: group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: homestead
--

ALTER SEQUENCE group_id_seq OWNED BY "group".id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: homestead; Tablespace: 
--

CREATE TABLE migrations (
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE migrations OWNER TO homestead;

--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: homestead; Tablespace: 
--

CREATE TABLE password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE password_resets OWNER TO homestead;

--
-- Name: user_groups; Type: TABLE; Schema: public; Owner: homestead; Tablespace: 
--

CREATE TABLE user_groups (
    user_id integer NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE user_groups OWNER TO homestead;

--
-- Name: user_notifications; Type: TABLE; Schema: public; Owner: homestead; Tablespace: 
--

CREATE TABLE user_notifications (
    id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    user_id integer NOT NULL,
    message character varying(255) NOT NULL,
    read boolean NOT NULL
);


ALTER TABLE user_notifications OWNER TO homestead;

--
-- Name: user_notifications_id_seq; Type: SEQUENCE; Schema: public; Owner: homestead
--

CREATE SEQUENCE user_notifications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_notifications_id_seq OWNER TO homestead;

--
-- Name: user_notifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: homestead
--

ALTER SEQUENCE user_notifications_id_seq OWNED BY user_notifications.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: homestead; Tablespace: 
--

CREATE TABLE users (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(60) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE users OWNER TO homestead;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: homestead
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_seq OWNER TO homestead;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: homestead
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: homestead
--

ALTER TABLE ONLY bookmarks ALTER COLUMN id SET DEFAULT nextval('bookmarks_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: homestead
--

ALTER TABLE ONLY categories ALTER COLUMN id SET DEFAULT nextval('categories_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: homestead
--

ALTER TABLE ONLY "group" ALTER COLUMN id SET DEFAULT nextval('group_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: homestead
--

ALTER TABLE ONLY user_notifications ALTER COLUMN id SET DEFAULT nextval('user_notifications_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: homestead
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Data for Name: bookmark_categories; Type: TABLE DATA; Schema: public; Owner: homestead
--

COPY bookmark_categories (bookmark_id, category_id) FROM stdin;
\.


--
-- Data for Name: bookmarks; Type: TABLE DATA; Schema: public; Owner: homestead
--

COPY bookmarks (id, user_id, name, url, description, image_url, created_at, updated_at) FROM stdin;
\.


--
-- Name: bookmarks_id_seq; Type: SEQUENCE SET; Schema: public; Owner: homestead
--

SELECT pg_catalog.setval('bookmarks_id_seq', 1, false);


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: homestead
--

COPY categories (id, name, description, user_id, created_at, updated_at) FROM stdin;
\.


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: homestead
--

SELECT pg_catalog.setval('categories_id_seq', 1, false);


--
-- Data for Name: group; Type: TABLE DATA; Schema: public; Owner: homestead
--

COPY "group" (id, created_at, updated_at, name, description) FROM stdin;
\.


--
-- Name: group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: homestead
--

SELECT pg_catalog.setval('group_id_seq', 1, false);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: homestead
--

COPY migrations (migration, batch) FROM stdin;
2014_10_12_000000_create_users_table	1
2014_10_12_100000_create_password_resets_table	1
2016_02_07_021851_create_groups_table	1
2016_02_07_033500_create_user_groups_table	1
2016_02_07_035914_create_categories_table	1
2016_02_07_040114_create_bookmarks_table	1
2016_02_07_203844_add_group_description_col	1
2016_02_07_235034_add_user_categories_table	1
2016_02_08_004933_change_user_category_m2m_to_12m	1
2016_02_08_011723_create_bookmark_categories_table	1
2016_02_08_013919_bookmarks_image_url_nullable	1
2016_02_11_025530_create_user_notifications	1
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: homestead
--

COPY password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: user_groups; Type: TABLE DATA; Schema: public; Owner: homestead
--

COPY user_groups (user_id, group_id) FROM stdin;
\.


--
-- Data for Name: user_notifications; Type: TABLE DATA; Schema: public; Owner: homestead
--

COPY user_notifications (id, created_at, updated_at, user_id, message, read) FROM stdin;
\.


--
-- Name: user_notifications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: homestead
--

SELECT pg_catalog.setval('user_notifications_id_seq', 1, false);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: homestead
--

COPY users (id, name, email, password, remember_token, created_at, updated_at) FROM stdin;
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: homestead
--

SELECT pg_catalog.setval('users_id_seq', 1, false);


--
-- Name: bookmarks_pkey; Type: CONSTRAINT; Schema: public; Owner: homestead; Tablespace: 
--

ALTER TABLE ONLY bookmarks
    ADD CONSTRAINT bookmarks_pkey PRIMARY KEY (id);


--
-- Name: categories_pkey; Type: CONSTRAINT; Schema: public; Owner: homestead; Tablespace: 
--

ALTER TABLE ONLY categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: group_pkey; Type: CONSTRAINT; Schema: public; Owner: homestead; Tablespace: 
--

ALTER TABLE ONLY "group"
    ADD CONSTRAINT group_pkey PRIMARY KEY (id);


--
-- Name: user_groups_user_id_group_id_unique; Type: CONSTRAINT; Schema: public; Owner: homestead; Tablespace: 
--

ALTER TABLE ONLY user_groups
    ADD CONSTRAINT user_groups_user_id_group_id_unique UNIQUE (user_id, group_id);


--
-- Name: user_notifications_pkey; Type: CONSTRAINT; Schema: public; Owner: homestead; Tablespace: 
--

ALTER TABLE ONLY user_notifications
    ADD CONSTRAINT user_notifications_pkey PRIMARY KEY (id);


--
-- Name: users_email_unique; Type: CONSTRAINT; Schema: public; Owner: homestead; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: homestead; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: homestead; Tablespace: 
--

CREATE INDEX password_resets_email_index ON password_resets USING btree (email);


--
-- Name: password_resets_token_index; Type: INDEX; Schema: public; Owner: homestead; Tablespace: 
--

CREATE INDEX password_resets_token_index ON password_resets USING btree (token);


--
-- Name: bookmark_categories_bookmark_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: homestead
--

ALTER TABLE ONLY bookmark_categories
    ADD CONSTRAINT bookmark_categories_bookmark_id_foreign FOREIGN KEY (bookmark_id) REFERENCES bookmarks(id);


--
-- Name: bookmark_categories_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: homestead
--

ALTER TABLE ONLY bookmark_categories
    ADD CONSTRAINT bookmark_categories_category_id_foreign FOREIGN KEY (category_id) REFERENCES categories(id);


--
-- Name: bookmarks_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: homestead
--

ALTER TABLE ONLY bookmarks
    ADD CONSTRAINT bookmarks_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: categories_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: homestead
--

ALTER TABLE ONLY categories
    ADD CONSTRAINT categories_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: user_groups_group_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: homestead
--

ALTER TABLE ONLY user_groups
    ADD CONSTRAINT user_groups_group_id_foreign FOREIGN KEY (group_id) REFERENCES "group"(id);


--
-- Name: user_groups_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: homestead
--

ALTER TABLE ONLY user_groups
    ADD CONSTRAINT user_groups_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: user_notifications_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: homestead
--

ALTER TABLE ONLY user_notifications
    ADD CONSTRAINT user_notifications_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

