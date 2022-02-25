INSERT INTO public.tm_relation_types (name)
VALUES ('owner'),
       ('executors'),
       ('auditors'),
       ('watchers');

SELECT setval('tm_relation_types_id_seq', max(id))
FROM public.tm_relation_types;
