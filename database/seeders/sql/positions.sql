insert into hr_positions (id)
values (1),
       (2),
       (3),
       (4),
       (5),
       (6),
       (7),
       (8),
       (9),
       (10),
       (11),
       (12),
       (13),
       (14),
       (15),
       (16);

insert into hr_position_translations (object_id, language_code, name)
values (1, 'ru', 'Директор'),
       (2, 'ru', 'Генеральный директор'),
       (3, 'ru', 'Оперативный директор'),
       (4, 'ru', 'Административный директор'),
       (5, 'ru', 'Директор по персоналу'),
       (6, 'ru', 'Коммерческий директор'),
       (7, 'ru', 'Финансовый директор'),
       (8, 'ru', 'Директор по производству'),
       (9, 'ru', 'Руководитель отдела'),
       (10, 'ru', 'Главный бухгалтер'),
       (11, 'ru', 'Руководитель направления'),
       (12, 'ru', 'Системный администратор'),
       (13, 'ru', 'Руководитель СБ'),
       (14, 'ru', 'Председатель совета директоров'),
       (15, 'ru', 'Руководитель службы'),
       (16, 'ru', 'Председатель совета');

SELECT setval('hr_positions_id_seq', max(id))
FROM public.hr_positions;

SELECT setval('hr_position_translations_id_seq', max(id))
FROM public.hr_position_translations;
