insert into hr_department_types (id, sequence)
values (1, 1);

insert into hr_department_type_translations (object_id, language_code, name)
values (1, 'ru', 'Предприятие');

SELECT setval('hr_department_types_id_seq', max(id))
FROM public.hr_department_types;

SELECT setval('hr_department_type_translations_id_seq', max(id))
FROM public.hr_department_type_translations;
