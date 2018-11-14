CREATE TABLE public.base (
    id integer NOT NULL,
    ip character varying NOT NULL,
    port character varying NOT NULL,
    nom character varying NOT NULL
);



CREATE SEQUENCE public."base_idBDD_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



ALTER SEQUENCE public."base_idBDD_seq" OWNED BY public.base.id;




CREATE TABLE public.compte (
    id integer NOT NULL,
    ndc character varying NOT NULL,
    mdp character varying NOT NULL,
    img text
);




CREATE TABLE public.correspondance (
    compte integer NOT NULL,
    base integer NOT NULL,
    mdp character varying NOT NULL
);




CREATE SEQUENCE public."user_idUser_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;




ALTER SEQUENCE public."user_idUser_seq" OWNED BY public.compte.id;



ALTER TABLE ONLY public.base ALTER COLUMN id SET DEFAULT nextval('public."base_idBDD_seq"'::regclass);


ALTER TABLE ONLY public.compte ALTER COLUMN id SET DEFAULT nextval('public."user_idUser_seq"'::regclass);



ALTER TABLE ONLY public.base
    ADD CONSTRAINT base_ip_port_nom_key UNIQUE (ip, port, nom);



ALTER TABLE ONLY public.base
    ADD CONSTRAINT base_pkey PRIMARY KEY (id);


ALTER TABLE ONLY public.compte
    ADD CONSTRAINT compte_pkey PRIMARY KEY (ndc);


ALTER TABLE ONLY public.correspondance
    ADD CONSTRAINT correspondance_pkey PRIMARY KEY (compte, base, mdp);


ALTER TABLE ONLY public.correspondance
    ADD CONSTRAINT "correspondance_idBDD_fkey" FOREIGN KEY (base) REFERENCES public.base(id);

