insert into public.tm_priorities (name)
values ('urgent'),
       ('high'),
       ('normal'),
       ('low');

SELECT setval('tm_priorities_id_seq', max(id))
FROM public.tm_priorities;
