--
-- PostgreSQL database dump
--

-- Dumped from database version 13.4 (Debian 13.4-1.pgdg100+1)
-- Dumped by pg_dump version 13.4 (Debian 13.4-1.pgdg100+1)

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

--
-- Name: tiger; Type: SCHEMA; Schema: -; Owner: dbuser
--

CREATE SCHEMA tiger;


ALTER SCHEMA tiger OWNER TO dbuser;

--
-- Name: tiger_data; Type: SCHEMA; Schema: -; Owner: dbuser
--

CREATE SCHEMA tiger_data;


ALTER SCHEMA tiger_data OWNER TO dbuser;

--
-- Name: topology; Type: SCHEMA; Schema: -; Owner: dbuser
--

CREATE SCHEMA topology;


ALTER SCHEMA topology OWNER TO dbuser;

--
-- Name: SCHEMA topology; Type: COMMENT; Schema: -; Owner: dbuser
--

COMMENT ON SCHEMA topology IS 'PostGIS Topology schema';


--
-- Name: fuzzystrmatch; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS fuzzystrmatch WITH SCHEMA public;


--
-- Name: EXTENSION fuzzystrmatch; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION fuzzystrmatch IS 'determine similarities and distance between strings';


--
-- Name: postgis; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;


--
-- Name: EXTENSION postgis; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis IS 'PostGIS geometry and geography spatial types and functions';


--
-- Name: postgis_tiger_geocoder; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS postgis_tiger_geocoder WITH SCHEMA tiger;


--
-- Name: EXTENSION postgis_tiger_geocoder; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis_tiger_geocoder IS 'PostGIS tiger geocoder and reverse geocoder';


--
-- Name: postgis_topology; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS postgis_topology WITH SCHEMA topology;


--
-- Name: EXTENSION postgis_topology; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis_topology IS 'PostGIS topology spatial types and functions';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: articles; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.articles (
    uuid uuid NOT NULL,
    title character varying(255) NOT NULL,
    description character varying(255) NOT NULL,
    article_content text NOT NULL,
    slug character varying(255) NOT NULL,
    post_img character varying(255),
    is_active boolean DEFAULT false,
    is_featured boolean DEFAULT false,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.articles OWNER TO dbuser;

--
-- Name: books; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.books (
    uuid uuid NOT NULL,
    name character varying(255) NOT NULL,
    description character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    is_featured boolean DEFAULT false,
    is_active boolean DEFAULT false,
    is_recommended boolean DEFAULT false,
    book_img character varying(255),
    book_pdf character varying(255),
    publish_date date NOT NULL,
    author character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.books OWNER TO dbuser;

--
-- Name: contacts; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.contacts (
    uuid uuid NOT NULL,
    email character varying(255) NOT NULL,
    first_name character varying(255) NOT NULL,
    last_name character varying(255) NOT NULL,
    message text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.contacts OWNER TO dbuser;

--
-- Name: events; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.events (
    uuid uuid NOT NULL,
    title character varying(255) NOT NULL,
    description character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    event_img character varying(255),
    event_date date NOT NULL,
    start_time time(0) without time zone NOT NULL,
    end_time time(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.events OWNER TO dbuser;

--
-- Name: galleries; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.galleries (
    uuid uuid NOT NULL,
    title character varying(255),
    description character varying(255),
    slug character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.galleries OWNER TO dbuser;

--
-- Name: gallery_images; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.gallery_images (
    uuid uuid NOT NULL,
    image character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.gallery_images OWNER TO dbuser;

--
-- Name: migrations; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO dbuser;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO dbuser;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: pages; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.pages (
    uuid uuid NOT NULL,
    title character varying(255) NOT NULL,
    description character varying(255) NOT NULL,
    body text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.pages OWNER TO dbuser;

--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO dbuser;

--
-- Name: researches; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.researches (
    uuid uuid NOT NULL,
    title character varying(255) NOT NULL,
    description character varying(255) NOT NULL,
    research_content text NOT NULL,
    slug character varying(255) NOT NULL,
    cover_image character varying(255),
    is_active boolean DEFAULT false,
    is_featured boolean DEFAULT false,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.researches OWNER TO dbuser;

--
-- Name: users; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.users (
    uuid uuid NOT NULL,
    first_name character varying(255) NOT NULL,
    last_name character varying(255) NOT NULL,
    username character varying(255),
    mobile character varying(255),
    email character varying(255),
    email_verified_at timestamp(0) without time zone,
    password character varying(255),
    status character varying(255) DEFAULT 'active'::character varying NOT NULL,
    national_id character varying(255) NOT NULL,
    language character varying(255) DEFAULT 'ar'::character varying NOT NULL,
    created_by uuid,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO dbuser;

--
-- Name: videos; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.videos (
    uuid uuid NOT NULL,
    title character varying(255) NOT NULL,
    description character varying(255) NOT NULL,
    video_url character varying(255),
    video_embed character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    cover_image character varying(255)
);


ALTER TABLE public.videos OWNER TO dbuser;

--
-- Name: visits; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.visits (
    id bigint NOT NULL,
    primary_key character varying(255) NOT NULL,
    secondary_key character varying(255),
    score bigint NOT NULL,
    list json,
    expired_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.visits OWNER TO dbuser;

--
-- Name: visits_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.visits_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.visits_id_seq OWNER TO dbuser;

--
-- Name: visits_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.visits_id_seq OWNED BY public.visits.id;


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: visits id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.visits ALTER COLUMN id SET DEFAULT nextval('public.visits_id_seq'::regclass);


--
-- Data for Name: articles; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.articles (uuid, title, description, article_content, slug, post_img, is_active, is_featured, created_at, updated_at, deleted_at) VALUES ('148dadb7-ea3a-44d4-a578-78a1be512615', 'مقال للدكتور طه ﺣﺴﻴﻦ', 'ان اﻟﻤﺬﻫﺐ جديد بالنسبة الي المعاصرين ولكنه قديم ﻓﻲ ﺣﻘﻴﻘﺔ الامر لانه ﻟﻴﺲ الا الدعوة اﻟﻘﻮﻳﺔ إﻟﻰ .....', '<p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 36px; line-height: 43px; font-size: 18px; word-spacing: 1px; font-family: Cairo, sans-serif; letter-spacing: 0.4px; background-color: #ffffff; text-align: right !important; padding: 12px 0px !important 12px 0px !important;">&nbsp;اﺳﺘﺠﺎﺑﺔ وﻟﻘﻴﺖُه ﺣﺎﺋﺮاً ﻳﻀﺮب أﺧﻤﺎﺳﺎً ﺑﺄﺳﺪﺎﺳ ، ﺿﺎﻗﺖ ﺑﻪ اﻟﺪﻧﻴﺎ وﻟﺎ ﻳﺪﺮﻳ ﻣﺎذﺍ ﻳﻌﻤﻞ ، ﺣﺎﻟﺘﻪ اﻟﻤﺎدﻳﺔ ﻣﻴﺴﻮرﺔ ، ﻟﺪﻳﻪ ﺳﻜﻦٌ وﻣﺰرﻋﺔ و وﺗﻘﺎﻋﺪٌ ﻳﻜﻔﻴﻪ اﻟﻌﻴﺶ ﺑﻘﻴﺔ ﻋﻤﺮه ، ﻳﻘﻀﻰ وﻗﺘﻪ ﻓﻲ اﻟﻤﺰرﻋﺔ ﻳﺘﻔﻘﺪ ﺷﺆوﻧﻬﺎ وﺷﺠﻮﻧﻬﺎ</p>
<p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 36px; line-height: 43px; font-size: 18px; word-spacing: 1px; font-family: Cairo, sans-serif; letter-spacing: 0.4px; background-color: #ffffff; text-align: right !important; padding: 12px 0px !important 12px 0px !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة ، زُﺭﺗﻪ ﻓﻲ اﺳﺘﺮاﺣﺘﻪ ﻓﺎﺷﺘﻜﻰ اﻟﻔﺮﺎﻏ وﺗﻤﻨﻰ ﻟﻮ اﺳﺘﻤﺮ ﻓﻲ وﻇﻴﻔﺘﻪ اﻟﺤﻜﻮﻣﻴﺔ وﻟﻮ ﺑﺎﻟﻤﺠﺎن ، وﺫﻛﺮ أﻧﻪ ﺗﻮﺳﻂ وﺗﺮﺟﻰ اﻟﺘﻤﺪﻳﺪ وﻟﻜﻦ ﻟﻢ ﻳﺠﺪ اﺳﺘﺠﺎﺑﺔ وﻟﻘﻴﺖُه ﺣﺎﺋﺮاً ﻳﻀﺮب أﺧﻤﺎﺳﺎً ﺑﺄﺳﺪﺎﺳ ، ﺿﺎﻗﺖ ﺑﻪ اﻟﺪﻧﻴﺎ وﻟﺎ ﻳﺪﺮﻳ ﻣﺎذﺍ ﻳﻌﻤﻞ ، ﺣﺎﻟﺘﻪ اﻟﻤﺎدﻳﺔ ﻣﻴﺴﻮرﺔ ، ﻟﺪﻳﻪ ﺳﻜﻦٌ وﻣﺰرﻋﺔ وﺳﻴﺎرﺔ وﺃﺳﺮة وﺗﻘﺎﻋﺪٌ ﻳﻜﻔﻴﻪ اﻟﻌﻴﺶ ﺑﻘﻴﺔ ﻋﻤﺮه ، ﻳﻘﻀﻰ وﻗﺘﻪ ﻓﻲ اﻟﻤﺰرﻋﺔ ﻳﺘﻔﻘﺪ ﺷﺆوﻧﻬﺎ وﺷﺠﻮﻧﻬﺎ</p>
<p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 36px; line-height: 43px; font-size: 18px; word-spacing: 1px; font-family: Cairo, sans-serif; letter-spacing: 0.4px; background-color: #ffffff; text-align: right !important; padding: 12px 0px !important 12px 0px !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة ، زُﺭﺗﻪ ﻓﻲ اﺳﺘﺮاﺣﺘﻪ ﻓﺎﺷﺘﻜﻰ اﻟﻔﺮﺎﻏ وﺗﻤﻨﻰ ﻟﻮ اﺳﺘﻤﺮ ﻓﻲ وﻇﻴﻔﺘﻪ اﻟﺤﻜﻮﻣﻴﺔ وﻟﻮ ﺑﺎﻟﻤﺠﺎن ، وﺫﻛﺮ أﻧﻪ ﺗﻮﺳﻂ وﺗﺮﺟﻰ اﻟﺘﻤﺪﻳﺪ وﻟﻜﻦ ﻟﻢ ﻳﺠﺪ اﺳﺘﺠﺎﺑﺔ وﻟﻘﻴﺖُه ﺣﺎﺋﺮاً ﻳﻀﺮب أﺧﻤﺎﺳﺎً ﺑﺄﺳﺪﺎﺳ ، ﺿﺎﻗﺖ ﺑﻪ اﻟﺪﻧﻴﺎ وﻟﺎ ﻳﺪﺮﻳ ﻣﺎذﺍ ﻳﻌﻤﻞ ، ﺣﺎﻟﺘﻪ اﻟﻤﺎدﻳﺔ ﻣﻴﺴﻮرﺔ ، ﻟﺪﻳﻪ ﺳﻜﻦٌ وﻣﺰرﻋﺔ وﺳﻴﺎرﺔ وﺃﺳﺮة وﺗﻘﺎﻋﺪٌ ﻳﻜﻔﻴﻪ اﻟﻌﻴﺶ ﺑﻘﻴﺔ ﻋﻤﺮه ، ﻳﻘﻀﻰ وﻗﺘﻪ ﻓﻲ اﻟﻤﺰرﻋﺔ ﻳﺘﻔﻘﺪ ﺷﺆوﻧﻬﺎ وﺷﺠﻮﻧﻬﺎ</p>
<p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 36px; line-height: 43px; font-size: 18px; word-spacing: 1px; font-family: Cairo, sans-serif; letter-spacing: 0.4px; background-color: #ffffff; text-align: right !important; padding: 12px 0px !important 12px 0px !important;" dir="rtl">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة ، زُﺭﺗﻪ ﻓﻲ اﺳﺘﺮاﺣﺘﻪ ﻓﺎﺷﺘﻜﻰ اﻟﻔﺮﺎﻏ وﺗﻤﻨﻰ ﻟﻮ اﺳﺘﻤﺮ ﻓﻲ وﻇﻴﻔﺘﻪ اﻟﺤﻜﻮﻣﻴﺔ وﻟﻮ ﺑﺎﻟﻤﺠﺎن ، وﺫﻛﺮ أﻧﻪ ﺗﻮﺳﻂ وﺗﺮﺟﻰ اﻟﺘﻤﺪﻳﺪ وﻟﻜﻦ ﻟﻢ ﻳﺠﺪ اﺳﺘﺠﺎﺑﺔ وﻟﻘﻴﺖُه ﺣﺎﺋﺮاً ﻳﻀﺮب أﺧﻤﺎﺳﺎً ﺑﺄﺳﺪﺎﺳ ، ﺿﺎﻗﺖ ﺑﻪ اﻟﺪﻧﻴﺎ وﻟﺎ ﻳﺪﺮﻳ ﻣﺎذﺍ ﻳﻌﻤﻞ ، ﺣﺎﻟﺘﻪ اﻟﻤﺎدﻳﺔ ﻣﻴﺴﻮرﺔ ، ﻟﺪﻳﻪ ﺳﻜﻦٌ وﻣﺰرﻋﺔ وﺳﻴﺎرﺔ وﺃﺳﺮة وﺗﻘﺎﻋﺪٌ ﻳﻜﻔﻴﻪ اﻟﻌﻴﺶ ﺑﻘﻴﺔ ﻋﻤﺮه ، ﻳﻘﻀﻰ وﻗﺘﻪ ﻓﻲ اﻟﻤﺰرﻋﺔ ﻳﺘﻔﻘﺪ ﺷﺆوﻧﻬﺎ وﺷﺠﻮﻧﻬﺎ</p>', 'mkal-lldktor-th', NULL, true, true, '2022-01-23 14:37:24', '2022-01-23 14:39:13', NULL);
INSERT INTO public.articles (uuid, title, description, article_content, slug, post_img, is_active, is_featured, created_at, updated_at, deleted_at) VALUES ('fc37678c-e2e5-4dec-b805-89ecbcde59f1', 'كورونا التخويف !', 'كورونا وﻣﺎ ادراك ما كورونا . ايه ﻣﻦ ايات الله ، معجزة ﻣﻦ معجزاته ، جنود مرعبة ﻟﺎ تري', '<p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 36px; line-height: 43px; font-size: 18px; word-spacing: 1px; font-family: Cairo, sans-serif; letter-spacing: 0.4px; background-color: #ffffff; text-align: right !important; padding: 12px 0px !important 12px 0px !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة ، زُﺭﺗﻪ ﻓﻲ اﺳﺘﺮاﺣﺘﻪ ﻓﺎﺷﺘﻜﻰ اﻟﻔﺮﺎﻏ وﺗﻤﻨﻰ ﻟﻮ اﺳﺘﻤﺮ ﻓﻲ وﻇﻴﻔﺘﻪ اﻟﺤﻜﻮﻣﻴﺔ وﻟﻮ ﺑﺎﻟﻤﺠﺎن ، وﺫﻛﺮ أﻧﻪ ﺗﻮﺳﻂ وﺗﺮﺟﻰ اﻟﺘﻤﺪﻳﺪ وﻟﻜﻦ ﻟﻢ ﻳﺠﺪ اﺳﺘﺠﺎﺑﺔ وﻟﻘﻴﺖُه ﺣﺎﺋﺮاً ﻳﻀﺮب أﺧﻤﺎﺳﺎً ﺑﺄﺳﺪﺎﺳ ، ﺿﺎﻗﺖ ﺑﻪ اﻟﺪﻧﻴﺎ وﻟﺎ ﻳﺪﺮﻳ ﻣﺎذﺍ ﻳﻌﻤﻞ ، ﺣﺎﻟﺘﻪ اﻟﻤﺎدﻳﺔ ﻣﻴﺴﻮرﺔ ، ﻟﺪﻳﻪ ﺳﻜﻦٌ وﻣﺰرﻋﺔ وﺳﻴﺎرﺔ وﺃﺳﺮة وﺗﻘﺎﻋﺪٌ ﻳﻜﻔﻴﻪ اﻟﻌﻴﺶ ﺑﻘﻴﺔ ﻋﻤﺮه ، ﻳﻘﻀﻰ وﻗﺘﻪ ﻓﻲ اﻟﻤﺰرﻋﺔ ﻳﺘﻔﻘﺪ ﺷﺆوﻧﻬﺎ وﺷﺠﻮﻧﻬﺎ</p>
<p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 36px; line-height: 43px; font-size: 18px; word-spacing: 1px; font-family: Cairo, sans-serif; letter-spacing: 0.4px; background-color: #ffffff; text-align: right !important; padding: 12px 0px !important 12px 0px !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة ، زُﺭﺗﻪ ﻓﻲ اﺳﺘﺮاﺣﺘﻪ ﻓﺎﺷﺘﻜﻰ اﻟﻔﺮﺎﻏ وﺗﻤﻨﻰ ﻟﻮ اﺳﺘﻤﺮ ﻓﻲ وﻇﻴﻔﺘﻪ اﻟﺤﻜﻮﻣﻴﺔ وﻟﻮ ﺑﺎﻟﻤﺠﺎن ، وﺫﻛﺮ أﻧﻪ ﺗﻮﺳﻂ وﺗﺮﺟﻰ اﻟﺘﻤﺪﻳﺪ وﻟﻜﻦ ﻟﻢ ﻳﺠﺪ اﺳﺘﺠﺎﺑﺔ وﻟﻘﻴﺖُه ﺣﺎﺋﺮاً ﻳﻀﺮب أﺧﻤﺎﺳﺎً ﺑﺄﺳﺪﺎﺳ ، ﺿﺎﻗﺖ ﺑﻪ اﻟﺪﻧﻴﺎ وﻟﺎ ﻳﺪﺮﻳ ﻣﺎذﺍ ﻳﻌﻤﻞ ، ﺣﺎﻟﺘﻪ اﻟﻤﺎدﻳﺔ ﻣﻴﺴﻮرﺔ ، ﻟﺪﻳﻪ ﺳﻜﻦٌ وﻣﺰرﻋﺔ وﺳﻴﺎرﺔ وﺃﺳﺮة وﺗﻘﺎﻋﺪٌ ﻳﻜﻔﻴﻪ اﻟﻌﻴﺶ ﺑﻘﻴﺔ ﻋﻤﺮه ، ﻳﻘﻀﻰ وﻗﺘﻪ ﻓﻲ اﻟﻤﺰرﻋﺔ ﻳﺘﻔﻘﺪ ﺷﺆوﻧﻬﺎ وﺷﺠﻮﻧﻬﺎ</p>
<p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 36px; line-height: 43px; font-size: 18px; word-spacing: 1px; font-family: Cairo, sans-serif; letter-spacing: 0.4px; background-color: #ffffff; text-align: right !important; padding: 12px 0px !important 12px 0px !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة ، زُﺭﺗﻪ ﻓﻲ اﺳﺘﺮاﺣﺘﻪ ﻓﺎﺷﺘﻜﻰ اﻟﻔﺮﺎﻏ وﺗﻤﻨﻰ ﻟﻮ اﺳﺘﻤﺮ ﻓﻲ وﻇﻴﻔﺘﻪ اﻟﺤﻜﻮﻣﻴﺔ وﻟﻮ ﺑﺎﻟﻤﺠﺎن ، وﺫﻛﺮ أﻧﻪ ﺗﻮﺳﻂ وﺗﺮﺟﻰ اﻟﺘﻤﺪﻳﺪ وﻟﻜﻦ ﻟﻢ ﻳﺠﺪ اﺳﺘﺠﺎﺑﺔ وﻟﻘﻴﺖُه ﺣﺎﺋﺮاً ﻳﻀﺮب أﺧﻤﺎﺳﺎً ﺑﺄﺳﺪﺎﺳ ، ﺿﺎﻗﺖ ﺑﻪ اﻟﺪﻧﻴﺎ وﻟﺎ ﻳﺪﺮﻳ ﻣﺎذﺍ ﻳﻌﻤﻞ ، ﺣﺎﻟﺘﻪ اﻟﻤﺎدﻳﺔ ﻣﻴﺴﻮرﺔ ، ﻟﺪﻳﻪ ﺳﻜﻦٌ وﻣﺰرﻋﺔ وﺳﻴﺎرﺔ وﺃﺳﺮة وﺗﻘﺎﻋﺪٌ ﻳﻜﻔﻴﻪ اﻟﻌﻴﺶ ﺑﻘﻴﺔ ﻋﻤﺮه ، ﻳﻘﻀﻰ وﻗﺘﻪ ﻓﻲ اﻟﻤﺰرﻋﺔ ﻳﺘﻔﻘﺪ ﺷﺆوﻧﻬﺎ وﺷﺠﻮﻧﻬﺎ</p>
<p style="box-sizing: inherit; margin-top: 0px; margin-bottom: 36px; line-height: 43px; font-size: 18px; word-spacing: 1px; font-family: Cairo, sans-serif; letter-spacing: 0.4px; background-color: #ffffff; text-align: right !important; padding: 12px 0px !important 12px 0px !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة ، زُﺭﺗﻪ ﻓﻲ اﺳﺘﺮاﺣﺘﻪ ﻓﺎﺷﺘﻜﻰ اﻟﻔﺮﺎﻏ وﺗﻤﻨﻰ ﻟﻮ اﺳﺘﻤﺮ ﻓﻲ وﻇﻴﻔﺘﻪ اﻟﺤﻜﻮﻣﻴﺔ وﻟﻮ ﺑﺎﻟﻤﺠﺎن ، وﺫﻛﺮ أﻧﻪ ﺗﻮﺳﻂ وﺗﺮﺟﻰ اﻟﺘﻤﺪﻳﺪ وﻟﻜﻦ ﻟﻢ ﻳﺠﺪ اﺳﺘﺠﺎﺑﺔ وﻟﻘﻴﺖُه ﺣﺎﺋﺮاً ﻳﻀﺮب أﺧﻤﺎﺳﺎً ﺑﺄﺳﺪﺎﺳ ، ﺿﺎﻗﺖ ﺑﻪ اﻟﺪﻧﻴﺎ وﻟﺎ ﻳﺪﺮﻳ ﻣﺎذﺍ ﻳﻌﻤﻞ ، ﺣﺎﻟﺘﻪ اﻟﻤﺎدﻳﺔ ﻣﻴﺴﻮرﺔ ، ﻟﺪﻳﻪ ﺳﻜﻦٌ وﻣﺰرﻋﺔ وﺳﻴﺎرﺔ وﺃﺳﺮة وﺗﻘﺎﻋﺪٌ ﻳﻜﻔﻴﻪ اﻟﻌﻴﺶ&nbsp;</p>', 'korona-altkhoyf', NULL, true, true, '2022-01-23 14:54:12', '2022-01-23 14:54:12', NULL);
INSERT INTO public.articles (uuid, title, description, article_content, slug, post_img, is_active, is_featured, created_at, updated_at, deleted_at) VALUES ('9cc76d66-d131-47f1-bf52-e1bc3241b0bb', 'حيرة متقاعد', 'ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة .زرته ﻓﻲ استراحة ﻓﺎﺷﺘﻜﻰ الفراغ وﺗﻤﻨﻰ ﻟﻮ استمر ﻓﻲ وظيفته', '<p><a href="https://bein-elhokol.web.app/articles.html#" style="box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: #a68454; text-decoration-line: none; border: 0px; border-radius: 5px; transition: all 0.3s ease 0s; outline-width: 0px; font-family: Cairo, sans-serif; font-size: 16px; letter-spacing: 0.4px;"></a></p>
<p class="card-txt green text_clamb" style="box-sizing: inherit; margin-bottom: 36px; line-height: 24px; display: inline !important; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: Cairo; font-size: 18px; text-align: right; color: rgba(95, 141, 105, 0.9); margin-top: 1.5rem !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة .زرته ﻓﻲ استراحة ﻓﺎﺷﺘﻜﻰ الفراغ وﺗﻤﻨﻰ ﻟﻮ استمر ﻓﻲ وظيفته</p>
<p class="card-txt green text_clamb" style="box-sizing: inherit; margin-bottom: 36px; line-height: 24px; display: inline !important; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: Cairo; font-size: 18px; text-align: right; color: rgba(95, 141, 105, 0.9); margin-top: 1.5rem !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة .زرته ﻓﻲ استراحة ﻓﺎﺷﺘﻜﻰ الفراغ وﺗﻤﻨﻰ ﻟﻮ استمر ﻓﻲ وظيفته</p>
<p class="card-txt green text_clamb" style="box-sizing: inherit; margin-bottom: 36px; line-height: 24px; display: inline !important; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: Cairo; font-size: 18px; text-align: right; color: rgba(95, 141, 105, 0.9); margin-top: 1.5rem !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة .زرته ﻓﻲ استراحة ﻓﺎﺷﺘﻜﻰ الفراغ وﺗﻤﻨﻰ ﻟﻮ استمر ﻓﻲ وظيفته</p>
<p class="card-txt green text_clamb" style="box-sizing: inherit; margin-bottom: 36px; line-height: 24px; display: inline !important; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: Cairo; font-size: 18px; text-align: right; color: rgba(95, 141, 105, 0.9); margin-top: 1.5rem !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة .زرته ﻓﻲ استراحة ﻓﺎﺷﺘﻜﻰ الفراغ وﺗﻤﻨﻰ ﻟﻮ استمر ﻓﻲ وظيفته</p>
<p class="card-txt green text_clamb" style="box-sizing: inherit; margin-bottom: 36px; line-height: 24px; display: inline !important; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: Cairo; font-size: 18px; text-align: right; color: rgba(95, 141, 105, 0.9); margin-top: 1.5rem !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة .زرته ﻓﻲ استراحة ﻓﺎﺷﺘﻜﻰ الفراغ وﺗﻤﻨﻰ ﻟﻮ استمر ﻓﻲ وظيفته</p>
<p class="card-txt green text_clamb" style="box-sizing: inherit; margin-bottom: 36px; line-height: 24px; display: inline !important; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: Cairo; font-size: 18px; text-align: right; color: rgba(95, 141, 105, 0.9); margin-top: 1.5rem !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة .زرته ﻓﻲ استراحة ﻓﺎﺷﺘﻜﻰ الفراغ وﺗﻤﻨﻰ ﻟﻮ استمر ﻓﻲ وظيفته</p>
<p class="card-txt green text_clamb" style="box-sizing: inherit; margin-bottom: 36px; line-height: 24px; display: inline !important; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: Cairo; font-size: 18px; text-align: right; color: rgba(95, 141, 105, 0.9); margin-top: 1.5rem !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة .زرته ﻓﻲ استراحة ﻓﺎﺷﺘﻜﻰ الفراغ وﺗﻤﻨﻰ ﻟﻮ استمر ﻓﻲ وظيفته</p>
<p class="card-txt green text_clamb" style="box-sizing: inherit; margin-bottom: 36px; line-height: 24px; display: inline !important; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: Cairo; font-size: 18px; text-align: right; color: rgba(95, 141, 105, 0.9); margin-top: 1.5rem !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة .زرته ﻓﻲ استراحة ﻓﺎﺷﺘﻜﻰ الفراغ وﺗﻤﻨﻰ ﻟﻮ استمر ﻓﻲ وظيفته</p>
<p class="card-txt green text_clamb" style="box-sizing: inherit; margin-bottom: 36px; line-height: 24px; display: inline !important; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: Cairo; font-size: 18px; text-align: right; color: rgba(95, 141, 105, 0.9); margin-top: 1.5rem !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة .زرته ﻓﻲ استراحة ﻓﺎﺷﺘﻜﻰ الفراغ وﺗﻤﻨﻰ ﻟﻮ استمر ﻓﻲ وظيفته</p>
<p class="card-txt green text_clamb" style="box-sizing: inherit; margin-bottom: 36px; line-height: 24px; display: inline !important; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: Cairo; font-size: 18px; text-align: right; color: rgba(95, 141, 105, 0.9); margin-top: 1.5rem !important;">ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة .زرته ﻓﻲ استراحة ﻓﺎﺷﺘﻜﻰ الفراغ وﺗﻤﻨﻰ ﻟﻮ استمر ﻓﻲ وظيفته</p>
<p class="card-txt green text_clamb" style="box-sizing: inherit; margin-top: 1.5rem !important; margin-bottom: 36px; line-height: 24px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-family: Cairo; font-style: normal; font-weight: normal; font-size: 18px; text-align: right; color: rgba(95, 141, 105, 0.9);"><a href="https://bein-elhokol.web.app/articles.html#" style="box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: #a68454; text-decoration-line: none; border: 0px; border-radius: 5px; transition: all 0.3s ease 0s; outline-width: 0px; font-family: Cairo, sans-serif; font-size: 16px; letter-spacing: 0.4px;"></a><a href="https://bein-elhokol.web.app/articles.html#" style="box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: #a68454; text-decoration-line: none; border: 0px; border-radius: 5px; transition: all 0.3s ease 0s; outline-width: 0px; font-family: Cairo, sans-serif; font-size: 16px; letter-spacing: 0.4px;"></a><a href="https://bein-elhokol.web.app/articles.html#" style="box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: #a68454; text-decoration-line: none; border: 0px; border-radius: 5px; transition: all 0.3s ease 0s; outline-width: 0px; font-family: Cairo, sans-serif; font-size: 16px; letter-spacing: 0.4px;"></a><a href="https://bein-elhokol.web.app/articles.html#" style="box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: #a68454; text-decoration-line: none; border: 0px; border-radius: 5px; transition: all 0.3s ease 0s; outline-width: 0px; font-family: Cairo, sans-serif; font-size: 16px; letter-spacing: 0.4px;"></a><a href="https://bein-elhokol.web.app/articles.html#" style="box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: #a68454; text-decoration-line: none; border: 0px; border-radius: 5px; transition: all 0.3s ease 0s; outline-width: 0px; font-family: Cairo, sans-serif; font-size: 16px; letter-spacing: 0.4px;"></a><a href="https://bein-elhokol.web.app/articles.html#" style="box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: #a68454; text-decoration-line: none; border: 0px; border-radius: 5px; transition: all 0.3s ease 0s; outline-width: 0px; font-family: Cairo, sans-serif; font-size: 16px; letter-spacing: 0.4px;"></a><a href="https://bein-elhokol.web.app/articles.html#" style="box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: #a68454; text-decoration-line: none; border: 0px; border-radius: 5px; transition: all 0.3s ease 0s; outline-width: 0px; font-family: Cairo, sans-serif; font-size: 16px; letter-spacing: 0.4px;"></a><a href="https://bein-elhokol.web.app/articles.html#" style="box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: #a68454; text-decoration-line: none; border: 0px; border-radius: 5px; transition: all 0.3s ease 0s; outline-width: 0px; font-family: Cairo, sans-serif; font-size: 16px; letter-spacing: 0.4px;"></a><a href="https://bein-elhokol.web.app/articles.html#" style="box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: #a68454; text-decoration-line: none; border: 0px; border-radius: 5px; transition: all 0.3s ease 0s; outline-width: 0px; font-family: Cairo, sans-serif; font-size: 16px; letter-spacing: 0.4px;"></a><a href="https://bein-elhokol.web.app/articles.html#" style="box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: #a68454; text-decoration-line: none; border: 0px; border-radius: 5px; transition: all 0.3s ease 0s; outline-width: 0px; font-family: Cairo, sans-serif; font-size: 16px; letter-spacing: 0.4px;"></a>ﺗﻌﻠﻴﻤﻪ ﻋﺎﻟﻲ وﺻﺤﺘﻪ ﺟﻴﺪة .زرته ﻓﻲ استراحة ﻓﺎﺷﺘﻜﻰ الفراغ وﺗﻤﻨﻰ ﻟﻮ استمر ﻓﻲ وظيفته</p>', 'hyr-mtkaaad', 'all/61f0dca504d97.png', true, true, '2022-01-23 14:55:05', '2022-01-26 06:00:59', NULL);


--
-- Data for Name: books; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.books (uuid, name, description, slug, is_featured, is_active, is_recommended, book_img, book_pdf, publish_date, author, created_at, updated_at) VALUES ('98945cb2-0d78-4d45-9889-922616f40b14', 'حيره مفلس', 'سلسله مكونه من اثني واربعون قصه متسلسله بسلاسل', 'hyrh-mfls', true, true, true, NULL, NULL, '2022-01-23', 'انا', '2022-01-23 15:00:00', '2022-01-23 15:00:00');
INSERT INTO public.books (uuid, name, description, slug, is_featured, is_active, is_recommended, book_img, book_pdf, publish_date, author, created_at, updated_at) VALUES ('700aa9f4-6332-413a-9b06-5454e8df81f2', 'Test', 'ewewweww', 'test', true, true, true, 'all/61f0d29026327.jpg', 'all/61f0d2c62f3f2.pdf', '2022-01-18', 'swswq', '2022-01-26 04:54:39', '2022-01-26 04:58:09');
INSERT INTO public.books (uuid, name, description, slug, is_featured, is_active, is_recommended, book_img, book_pdf, publish_date, author, created_at, updated_at) VALUES ('d21c8a6f-5b1e-4515-8579-bfbfcd1b5f63', 'أنسانية ملك', 'سلسله مكونه من اثني واربعون قصه متسلسله بسلاسل', 'ansany-mlk', true, true, true, 'all/61f0d29026327.jpg', 'storage/files', '2022-01-23', 'دكتور عبد العزيز بن عبد الرحمن', '2022-01-23 14:59:19', '2022-01-26 06:04:56');


--
-- Data for Name: contacts; Type: TABLE DATA; Schema: public; Owner: dbuser
--



--
-- Data for Name: events; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.events (uuid, title, description, slug, event_img, event_date, start_time, end_time, created_at, updated_at, deleted_at) VALUES ('4c97a7b3-3636-406f-8c92-99b205ad5e28', 'ندوه ثقافيه', 'سلسله مكونه من اثني واربعون قصه متسلسله بسلاسل', 'ndoh-thkafyh', NULL, '2022-01-23', '17:01:00', '17:27:00', '2022-01-23 15:01:15', '2022-01-23 15:01:15', NULL);
INSERT INTO public.events (uuid, title, description, slug, event_img, event_date, start_time, end_time, created_at, updated_at, deleted_at) VALUES ('4493dbde-96b3-436c-8c36-a18a25f640e0', 'ندوه تانيه', 'سلسله مكونه من اثني واربعون قصه متسلسله بسلاسل', 'ndoh-tanyh', NULL, '2022-01-23', '17:01:00', '18:01:00', '2022-01-23 15:01:36', '2022-01-23 15:01:36', NULL);


--
-- Data for Name: galleries; Type: TABLE DATA; Schema: public; Owner: dbuser
--



--
-- Data for Name: gallery_images; Type: TABLE DATA; Schema: public; Owner: dbuser
--



--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.migrations (id, migration, batch) VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (3, '2021_12_28_131922_create_articles_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (4, '2021_12_28_131922_create_books_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (5, '2021_12_28_131922_create_contacts_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (6, '2021_12_28_131922_create_events_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (7, '2021_12_28_131922_create_galleries_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (8, '2021_12_28_131922_create_gallery_images_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (9, '2021_12_28_131922_create_videos_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (10, '2022_01_23_132307_create_researches_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (11, '2022_01_23_141848_create_pages_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (12, '2022_01_26_055157_add_image_to_videos_table', 2);
INSERT INTO public.migrations (id, migration, batch) VALUES (13, '2022_01_26_065142_create_visits_table', 3);


--
-- Data for Name: pages; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.pages (uuid, title, description, body, created_at, updated_at, deleted_at) VALUES ('436f1b62-1a28-4a3d-be04-d071a3b6e823', 'الملف الشخصي', 'الملف الشخصي', '<pre class="language-markup"><code></code></pre>
<div class="profile" data-aos="fade">
<section class="image_with_text position-relative">
<div clas="row"><!-- profile image -->
<div class="p-0 col-md-12 col-lg-6 profile_image"><img src="{{asset(''front'')}}/assets/img/profile.png" /></div>
</div>
<div class="container">
<div class="row"><!-- info -->
<div class="col-md-12 col-lg-6 info_profile layout_wrapper">
<div class="right_side">
<div class="p-0">
<h1 class="pageDescription">الملف الشخصي</h1>
<div class="row">
<div class="col-12 about section_info">
<div class="row"><!-- name -->
<div class="col-xs-12 col-md-6 about">
<p>الاسم والشهرة</p>
</div>
<div class="col-xs-12 col-md-6 details">
<p>د.عبد العزيز بن عبد الرحمن الثنيان</p>
</div>
<!-- born -->
<div class="col-xs-12 col-md-6 about">
<p>مكان و تاريخ الولادة</p>
</div>
<div class="col-xs-12 col-md-6 details">
<p>الرياض _ 1369 هـ</p>
</div>
<!-- Status -->
<div class="col-xs-12 col-md-6 about">
<p>الحالة الاجتماعية</p>
</div>
<div class="col-xs-12 col-md-6 details">
<p>متزوج ورب أسرة</p>
</div>
<!-- education -->
<div class="col-xs-12 col-md-6 about">
<p>المؤهل العلمي</p>
</div>
<div class="col-xs-12 col-md-6 details">
<p>دكتوراة في الادب العربي عام 1401 هـ جامعة الامام محمد بن سعود الاسلامية</p>
</div>
<!-- current job -->
<div class="col-xs-12 col-md-6 about">
<p>الاعمال الحالية</p>
</div>
<div class="col-xs-12 col-md-6 details">
<p>الامين العام لمؤسسة الرياض الخيرية للعلوم <br />نائب رئيس مجلس امناء جامعة الامير سلطان الاهلية <br />رئيس مجلس أدارة شركه ابن خلدون التعليمية</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- last jobs -->
<section class="profile_section with_bg">
<div class="container">
<div class="row ">
<div class="col-12 about">
<div class="row"><!-- name -->
<div class="col-xs-12 col-md-3 about">
<p class="font_30">الاعمال السابقة</p>
</div>
<div class="col-xs-12 col-md-9 pt-2 details white_text_profile">
<p><span>1402 هـ 1412 هـ</span> مدير عام التعليم بمنطقة الرياض</p>
<p><span>1402 هـ 1412 هـ</span> مدير عام التعليم بمنطقة الرياض</p>
<p><span>1402 هـ 1412 هـ</span> مدير عام التعليم بمنطقة الرياض</p>
<p><span>1402 هـ 1412 هـ</span> مدير عام التعليم بمنطقة الرياض</p>
<p><span>1402 هـ 1412 هـ</span> مدير عام التعليم بمنطقة الرياض</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- section two -->
<section class="profile_section" data-aos="fade">
<div class="container">
<div class="row">
<div class="col-12 about" data-aos="fade">
<div class="row"><!-- name -->
<div class="col-xs-12 col-md-3 about">
<p class="font_30">عضوية مجالس <br />و لجان</p>
</div>
<div class="col-xs-12 col-md-6 details">
<p><span>1402 هـ 1412 هـ</span> مدير عام التعليم بمنطقة الرياض</p>
<p><span>1402 هـ 1412 هـ</span> مدير عام التعليم بمنطقة الرياض</p>
<p><span>1402 هـ 1412 هـ</span> مدير عام التعليم بمنطقة الرياض</p>
<p><span>1402 هـ 1412 هـ</span> مدير عام التعليم بمنطقة الرياض</p>
<p><span>1402 هـ 1412 هـ</span> مدير عام التعليم بمنطقة الرياض</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Events -->
<section class="profile_section with_bg" data-aos="fade">
<div class="container">
<div class="row">
<div class="col-12 about">
<div class="row"><!-- name -->
<div class="col-xs-12 col-md-3 about">
<p class="font_30">المؤتمرات و الندوات</p>
</div>
<div class="col-xs-12 col-md-9 details white_text_profile">
<div class="pt-2 d-flex">-
<p class="">رئاسة وفد المملكة في بعض المؤتمرات رئاسة وفد المملكة في بعض المؤتمراترئاسة وفد المملكة في بعض المؤتمراترئاسة وفد المملكة في بعض المؤتمراترئاسة وفد المملكة في بعض المؤتمرات</p>
</div>
<div class="pt-3 d-flex">-
<p class="">رئاسة وفد المملكة في بعض المؤتمرات رئاسة وفد المملكة في بعض المؤتمراترئاسة وفد المملكة في بعض المؤتمراترئاسة وفد المملكة في بعض المؤتمراترئاسة وفد المملكة في بعض المؤتمرات</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- last section -->
<section class="profile_section" data-aos="fade">
<div class="container">
<div class="row ">
<div class="col-12 about">
<div class="row"><!-- name -->
<div class="col-xs-12 col-md-3 about text-xs-center">
<p class="font_30">المؤلفات</p>
</div>
<div class="col-xs-12 pt-2 col-md-9 details">
<ul class="p-0">
<li>
<p>رئاسة وفد المملكة في بعض المؤتمرات</p>
</li>
<li>
<p>رئاسة وفد المملكة في بعض المؤتمرات</p>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
<pre class="language-markup"><code></code></pre>', '2022-01-23 14:32:05', '2022-01-23 14:48:42', NULL);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: dbuser
--



--
-- Data for Name: researches; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.researches (uuid, title, description, research_content, slug, cover_image, is_active, is_featured, created_at, updated_at, deleted_at) VALUES ('8a478bc7-d160-4360-a962-e403b8c55b7c', 'ytyt', 'trtrt', '<p>6456456456</p>', 'ytyt', 'all/61f0dca504d97.png', true, true, '2022-01-26 06:12:51', '2022-01-26 06:12:51', NULL);


--
-- Data for Name: spatial_ref_sys; Type: TABLE DATA; Schema: public; Owner: dbuser
--



--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.users (uuid, first_name, last_name, username, mobile, email, email_verified_at, password, status, national_id, language, created_by, remember_token, created_at, updated_at, deleted_at) VALUES ('746149b4-466f-4dcd-b07a-33e474418fb8', 'admin', 'admin', NULL, NULL, 'admin@admin.com', NULL, '$2y$10$p9j9vzFFRhgxXQ.ASKI7G.zwk5RF771SSsbcqtxl8dOFvM5WXOB/i', 'active', '12345678', 'ar', '746149b4-466f-4dcd-b07a-33e474418fb8', '936x6b1fb7HwmcVynXMN2JQnNBeLFuYWhq6AUXnrh8d2AzgSBdH4qOD5RVaX', NULL, NULL, NULL);


--
-- Data for Name: videos; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.videos (uuid, title, description, video_url, video_embed, created_at, updated_at, deleted_at, cover_image) VALUES ('c4fb2666-5fde-4d4e-b423-537d40f85818', 'احسنتي يارباب', 'احسنتي يارباب', 'https://www.youtube.com/watch?v=OT4BxeibB04&ab_channel=OscarSeries', '<iframe width="560" height="315" src="https://www.youtube.com/embed/OT4BxeibB04" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>', '2022-01-23 15:05:19', '2022-01-26 06:04:39', NULL, 'all/61f0d29026327.jpg');


--
-- Data for Name: visits; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (27, 'visits:events_visits_recorded_ips:4493dbde-96b3-436c-8c36-a18a25f640e0:172.22.0.1', NULL, 1, NULL, '2022-01-26 07:16:29', '2022-01-26 07:01:29', '2022-01-26 07:01:29');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (9, 'visits:articles_visits_recorded_ips:9cc76d66-d131-47f1-bf52-e1bc3241b0bb:172.22.0.1', NULL, 1, NULL, '2022-01-26 07:11:17', '2022-01-26 06:56:17', '2022-01-26 06:56:17');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (10, 'visits:articles_visits', '9cc76d66-d131-47f1-bf52-e1bc3241b0bb', 1, NULL, NULL, '2022-01-26 06:56:17', '2022-01-26 06:56:17');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (11, 'visits:articles_visits_total', NULL, 1, NULL, NULL, '2022-01-26 06:56:17', '2022-01-26 06:56:17');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (12, 'visits:articles_visits_referers:9cc76d66-d131-47f1-bf52-e1bc3241b0bb', NULL, 1, NULL, NULL, '2022-01-26 06:56:17', '2022-01-26 06:56:17');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (28, 'visits:events_visits', '4493dbde-96b3-436c-8c36-a18a25f640e0', 1, NULL, NULL, '2022-01-26 07:01:29', '2022-01-26 07:01:29');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (29, 'visits:events_visits_total', NULL, 1, NULL, NULL, '2022-01-26 07:01:29', '2022-01-26 07:01:29');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (30, 'visits:events_visits_referers:4493dbde-96b3-436c-8c36-a18a25f640e0', NULL, 1, NULL, NULL, '2022-01-26 07:01:29', '2022-01-26 07:01:29');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (17, 'visits:articles_visits_OSes:9cc76d66-d131-47f1-bf52-e1bc3241b0bb', 'Linux', 1, NULL, NULL, '2022-01-26 06:56:17', '2022-01-26 06:56:17');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (18, 'visits:articles_visits_languages:9cc76d66-d131-47f1-bf52-e1bc3241b0bb', 'en', 1, NULL, NULL, '2022-01-26 06:56:17', '2022-01-26 06:56:17');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (35, 'visits:events_visits_OSes:4493dbde-96b3-436c-8c36-a18a25f640e0', 'Linux', 1, NULL, NULL, '2022-01-26 07:01:30', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (36, 'visits:events_visits_languages:4493dbde-96b3-436c-8c36-a18a25f640e0', 'en', 1, NULL, NULL, '2022-01-26 07:01:30', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (31, 'visits:events_visits_day', '4493dbde-96b3-436c-8c36-a18a25f640e0', 1, NULL, '2022-01-27 00:00:00', '2022-01-26 07:01:29', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (20, 'visits:events_visits_day', '0', 0, NULL, '2022-01-27 00:00:00', '2022-01-26 07:01:29', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (19, 'visits:events_visits_day_total', NULL, 1, NULL, '2022-01-27 00:00:00', '2022-01-26 07:01:28', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (32, 'visits:events_visits_week', '4493dbde-96b3-436c-8c36-a18a25f640e0', 1, NULL, '2022-01-31 00:00:00', '2022-01-26 07:01:29', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (2, 'visits:articles_visits_day', '0', 0, NULL, '2022-01-27 00:00:00', '2022-01-26 06:56:16', '2022-01-26 07:00:06');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (13, 'visits:articles_visits_day', '9cc76d66-d131-47f1-bf52-e1bc3241b0bb', 1, NULL, '2022-01-27 00:00:00', '2022-01-26 06:56:17', '2022-01-26 07:00:06');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (1, 'visits:articles_visits_day_total', NULL, 1, NULL, '2022-01-27 00:00:00', '2022-01-26 06:56:16', '2022-01-26 07:00:06');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (4, 'visits:articles_visits_week', '0', 0, NULL, '2022-01-31 00:00:00', '2022-01-26 06:56:16', '2022-01-26 07:00:06');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (14, 'visits:articles_visits_week', '9cc76d66-d131-47f1-bf52-e1bc3241b0bb', 1, NULL, '2022-01-31 00:00:00', '2022-01-26 06:56:17', '2022-01-26 07:00:06');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (3, 'visits:articles_visits_week_total', NULL, 1, NULL, '2022-01-31 00:00:00', '2022-01-26 06:56:16', '2022-01-26 07:00:06');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (6, 'visits:articles_visits_month', '0', 0, NULL, '2022-02-01 00:00:00', '2022-01-26 06:56:17', '2022-01-26 07:00:06');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (15, 'visits:articles_visits_month', '9cc76d66-d131-47f1-bf52-e1bc3241b0bb', 1, NULL, '2022-02-01 00:00:00', '2022-01-26 06:56:17', '2022-01-26 07:00:06');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (5, 'visits:articles_visits_month_total', NULL, 1, NULL, '2022-02-01 00:00:00', '2022-01-26 06:56:16', '2022-01-26 07:00:06');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (8, 'visits:articles_visits_year', '0', 0, NULL, '2023-01-01 00:00:00', '2022-01-26 06:56:17', '2022-01-26 07:00:06');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (22, 'visits:events_visits_week', '0', 0, NULL, '2022-01-31 00:00:00', '2022-01-26 07:01:29', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (21, 'visits:events_visits_week_total', NULL, 1, NULL, '2022-01-31 00:00:00', '2022-01-26 07:01:29', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (24, 'visits:events_visits_month', '0', 0, NULL, '2022-02-01 00:00:00', '2022-01-26 07:01:29', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (33, 'visits:events_visits_month', '4493dbde-96b3-436c-8c36-a18a25f640e0', 1, NULL, '2022-02-01 00:00:00', '2022-01-26 07:01:29', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (23, 'visits:events_visits_month_total', NULL, 1, NULL, '2022-02-01 00:00:00', '2022-01-26 07:01:29', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (26, 'visits:events_visits_year', '0', 0, NULL, '2023-01-01 00:00:00', '2022-01-26 07:01:29', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (34, 'visits:events_visits_year', '4493dbde-96b3-436c-8c36-a18a25f640e0', 1, NULL, '2023-01-01 00:00:00', '2022-01-26 07:01:29', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (25, 'visits:events_visits_year_total', NULL, 1, NULL, '2023-01-01 00:00:00', '2022-01-26 07:01:29', '2022-01-26 07:01:30');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (16, 'visits:articles_visits_year', '9cc76d66-d131-47f1-bf52-e1bc3241b0bb', 1, NULL, '2023-01-01 00:00:00', '2022-01-26 06:56:17', '2022-01-26 07:00:06');
INSERT INTO public.visits (id, primary_key, secondary_key, score, list, expired_at, created_at, updated_at) VALUES (7, 'visits:articles_visits_year_total', NULL, 1, NULL, '2023-01-01 00:00:00', '2022-01-26 06:56:17', '2022-01-26 07:00:06');


--
-- Data for Name: geocode_settings; Type: TABLE DATA; Schema: tiger; Owner: dbuser
--



--
-- Data for Name: pagc_gaz; Type: TABLE DATA; Schema: tiger; Owner: dbuser
--



--
-- Data for Name: pagc_lex; Type: TABLE DATA; Schema: tiger; Owner: dbuser
--



--
-- Data for Name: pagc_rules; Type: TABLE DATA; Schema: tiger; Owner: dbuser
--



--
-- Data for Name: topology; Type: TABLE DATA; Schema: topology; Owner: dbuser
--



--
-- Data for Name: layer; Type: TABLE DATA; Schema: topology; Owner: dbuser
--



--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.migrations_id_seq', 13, true);


--
-- Name: visits_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.visits_id_seq', 36, true);


--
-- Name: articles articles_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.articles
    ADD CONSTRAINT articles_pkey PRIMARY KEY (uuid);


--
-- Name: articles articles_slug_unique; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.articles
    ADD CONSTRAINT articles_slug_unique UNIQUE (slug);


--
-- Name: books books_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.books
    ADD CONSTRAINT books_pkey PRIMARY KEY (uuid);


--
-- Name: books books_slug_unique; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.books
    ADD CONSTRAINT books_slug_unique UNIQUE (slug);


--
-- Name: contacts contacts_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.contacts
    ADD CONSTRAINT contacts_pkey PRIMARY KEY (uuid);


--
-- Name: events events_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.events
    ADD CONSTRAINT events_pkey PRIMARY KEY (uuid);


--
-- Name: galleries galleries_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.galleries
    ADD CONSTRAINT galleries_pkey PRIMARY KEY (uuid);


--
-- Name: gallery_images gallery_images_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.gallery_images
    ADD CONSTRAINT gallery_images_pkey PRIMARY KEY (uuid);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: pages pages_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.pages
    ADD CONSTRAINT pages_pkey PRIMARY KEY (uuid);


--
-- Name: researches researches_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.researches
    ADD CONSTRAINT researches_pkey PRIMARY KEY (uuid);


--
-- Name: researches researches_slug_unique; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.researches
    ADD CONSTRAINT researches_slug_unique UNIQUE (slug);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_mobile_unique; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_mobile_unique UNIQUE (mobile);


--
-- Name: users users_national_id_unique; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_national_id_unique UNIQUE (national_id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (uuid);


--
-- Name: users users_username_unique; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_unique UNIQUE (username);


--
-- Name: videos videos_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.videos
    ADD CONSTRAINT videos_pkey PRIMARY KEY (uuid);


--
-- Name: visits visits_pkey; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.visits
    ADD CONSTRAINT visits_pkey PRIMARY KEY (id);


--
-- Name: visits visits_primary_key_secondary_key_unique; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.visits
    ADD CONSTRAINT visits_primary_key_secondary_key_unique UNIQUE (primary_key, secondary_key);


--
-- Name: articles_is_active_index; Type: INDEX; Schema: public; Owner: dbuser
--

CREATE INDEX articles_is_active_index ON public.articles USING btree (is_active);


--
-- Name: articles_is_featured_index; Type: INDEX; Schema: public; Owner: dbuser
--

CREATE INDEX articles_is_featured_index ON public.articles USING btree (is_featured);


--
-- Name: books_is_active_index; Type: INDEX; Schema: public; Owner: dbuser
--

CREATE INDEX books_is_active_index ON public.books USING btree (is_active);


--
-- Name: books_is_featured_index; Type: INDEX; Schema: public; Owner: dbuser
--

CREATE INDEX books_is_featured_index ON public.books USING btree (is_featured);


--
-- Name: books_is_recommended_index; Type: INDEX; Schema: public; Owner: dbuser
--

CREATE INDEX books_is_recommended_index ON public.books USING btree (is_recommended);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: dbuser
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: researches_is_active_index; Type: INDEX; Schema: public; Owner: dbuser
--

CREATE INDEX researches_is_active_index ON public.researches USING btree (is_active);


--
-- Name: researches_is_featured_index; Type: INDEX; Schema: public; Owner: dbuser
--

CREATE INDEX researches_is_featured_index ON public.researches USING btree (is_featured);


--
-- Name: users_created_by_index; Type: INDEX; Schema: public; Owner: dbuser
--

CREATE INDEX users_created_by_index ON public.users USING btree (created_by);


--
-- PostgreSQL database dump complete
--

