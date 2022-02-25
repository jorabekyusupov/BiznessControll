insert into public.tm_types (name)
values ('task'),
       ('project'),
       ('training'),
       ('regular_actions');

SELECT setval('tm_types_id_seq', max(id))
FROM public.tm_types;
