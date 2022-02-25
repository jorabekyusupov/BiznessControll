insert into public.phrases (id, word, page_id)
values (9999, 'test', NULL);

INSERT INTO public.phrase_translations (object_id, language_code, translation)
values (9999, 'ru', 'Test');

SELECT setval('phrases_id_seq', (SELECT MAX(id) FROM phrases));
SELECT setval('phrase_translations_id_seq', (SELECT MAX(id) FROM phrase_translations));
