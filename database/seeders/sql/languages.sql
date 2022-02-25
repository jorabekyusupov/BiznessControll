insert into languages (name, code, is_active)
values ('Русский', 'ru', 1);

SELECT setval('languages_id_seq', max(id)) FROM public.languages;
