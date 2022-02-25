INSERT INTO public.nationalities (name)
VALUES ('Ўзбек'),
       ('Русский');

SELECT setval('nationalities_id_seq', max(id))
FROM public.nationalities;
