insert into public.tm_statuses (color, name)
values ('grey','open'),
       ('blue','processing'),
       ('indigo','review'),
       ('green','closed');

SELECT setval('tm_statuses_id_seq', max(id))
FROM public.tm_statuses;
