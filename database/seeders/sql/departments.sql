INSERT INTO public.hr_departments (id, parent_id, department_type_id, sequence, single_block, code)
VALUES (22, 8, 1, 1, false, '11113'),
       (26, 9, 1, 1, false, '11121'),
       (1, null, 1, 1, false, '1'),
       (46, 15, 1, 1, false, '11412'),
       (27, 9, 1, 1, false, '11122'),
       (20, 19, 1, 1, false, '8'),
       (28, 9, 1, 1, false, '11123'),
       (35, 11, 1, 1, false, '11222'),
       (23, 9, 1, 1, false, '9'),
       (24, 9, 1, 1, false, '9'),
       (25, 9, 1, 1, false, '9'),
       (36, 12, 1, 1, false, '11231'),
       (37, 12, 1, 1, false, '11232'),
       (47, 17, 1, 1, false, '1211'),
       (2, 1, 1, 1, false, '11'),
       (3, 1, 1, 1, false, '12'),
       (4, 2, 1, 1, false, '111'),
       (5, 2, 1, 1, false, '112'),
       (6, 2, 1, 1, false, '113'),
       (7, 2, 1, 1, false, '114'),
       (19, 8, 1, 1, false, '11111'),
       (21, 8, 1, 1, false, '11112'),
       (29, 10, 1, 1, false, '11211'),
       (30, 10, 1, 1, false, '11212'),
       (31, 10, 1, 1, false, '11213'),
       (32, 10, 1, 1, false, '11214'),
       (33, 10, 1, 1, false, '11215'),
       (34, 11, 1, 1, false, '11221'),
       (38, 13, 1, 1, false, '11311'),
       (39, 13, 1, 1, false, '11312'),
       (40, 13, 1, 1, false, '11313'),
       (41, 13, 1, 1, false, '11314'),
       (44, 14, 1, 1, false, '11321'),
       (43, 14, 1, 1, false, '11322'),
       (42, 14, 1, 1, false, '11323'),
       (45, 15, 1, 1, false, '11411'),
       (48, 17, 1, 1, false, '1212'),
       (49, 17, 1, 1, false, '1213'),
       (50, 18, 1, 1, false, '1221'),
       (51, 18, 1, 1, false, '1222'),
       (52, 18, 1, 1, false, '1223'),
       (9, 4, 1, 1, true, '1112'),
       (8, 4, 1, 1, true, '1111'),
       (12, 5, 1, 1, true, '1123'),
       (11, 5, 1, 1, true, '1122'),
       (10, 5, 1, 1, true, '1121'),
       (14, 6, 1, 1, true, '1132'),
       (13, 6, 1, 1, true, '1131'),
       (16, 7, 1, 1, true, '1142'),
       (15, 7, 1, 1, true, '1141'),
       (18, 3, 1, 1, true, '122'),
       (17, 3, 1, 1, true, '121');

insert into hr_department_translations (object_id, language_code, name)
VALUES (49, 'ru', '?????????????????????? ???????????? ??????????'),
       (50, 'ru', '?????????? ????????????????????'),
       (51, 'ru', '???????????? ?????????????????????????????? ????????????????????'),
       (52, 'ru', '?????????? ??????????????????????????'),
       (1, 'ru', '?????? ????????????????'),
       (33, 'ru', '?????????????????????? ???????????????????????? ????????????????????'),
       (34, 'ru', '?????????????????????? ???????????????? ????????????'),
       (35, 'ru', '?????????????????????? ???????????? ????????????'),
       (2, 'ru', '???????????????????????? ????????????????????'),
       (3, 'ru', '???????????????????????????????? ????????????????????'),
       (4, 'ru', '???????????????????? ??????????????????'),
       (20, 'ru', '?????????????????????? ???? ???????????? ?? ????????????????????'),
       (36, 'ru', '?????????????????????? ???? ???????????? ?? ?????????????????? ??????????????????'),
       (5, 'ru', '???????????????????????? ????????????????????'),
       (37, 'ru', '?????????????????????? ?????????????????????????? ????????????????'),
       (23, 'ru', '????????????????'),
       (6, 'ru', '???????????????????? ????????????????????'),
       (7, 'ru', '???????????????????????????????? ??????????????????'),
       (24, 'ru', '????????????????'),
       (25, 'ru', '?????????????????????????? ??????????????????????'),
       (19, 'ru', '?????????????????????? ?????????????? ??????????????????'),
       (21, 'ru', '?????????????????????? ???? ???????????? ?? ????????????????????'),
       (22, 'ru', '?????????????????????? ?????????????????? ??????????'),
       (26, 'ru', '????????????????'),
       (27, 'ru', '?????????????????????????? ??????????????????????'),
       (28, 'ru', 'IT ??????????????????????'),
       (38, 'ru', '???????????????????????? ??????????????????????'),
       (29, 'ru', '?????????????????????? PR'),
       (30, 'ru', '?????????????????????? ???????????????? ??????????????????????'),
       (31, 'ru', '?????????????????????? ???????????? ??????????????????????'),
       (32, 'ru', '?????????????????????? ??????????????'),
       (39, 'ru', '?????????????????????? ???????????????????? ??????????'),
       (40, 'ru', '?????????????????????? ???????????????????? ??????????'),
       (41, 'ru', '?????????????????????? ?????????????????????? ????????????'),
       (44, 'ru', '?????????????????????? ?????????????????????? ????????????????????????'),
       (43, 'ru', '?????????????????????? ???????????????? ?? ???????????????????? ?? ??????????????????????'),
       (42, 'ru', '?????????????????????? ???? ???????????????????? ?????????????????? ????????????????????'),
       (45, 'ru', '?????????????????????? ??????????????????'),
       (46, 'ru', '?????????????????????? ???????????????????????? ????????????????????????'),
       (47, 'ru', '???????????? ????????????????????????'),
       (48, 'ru', '?????????????????????? ??????????????????????'),
       (9, 'ru', '??????????????????????????????-?????????????????????????? ??????????'),
       (8, 'ru', '???????????? ??????????????????'),
       (12, 'ru', '?????????? ???? ???????????? ?? ??????????????????'),
       (11, 'ru', '?????????? ????????????'),
       (10, 'ru', '?????????? ????????????????????'),
       (14, 'ru', '???????????????????? ??????????'),
       (13, 'ru', '??????????????????????'),
       (16, 'ru', '?????????? ????????????????????????'),
       (15, 'ru', '?????????? ??????????????'),
       (18, 'ru', '???????????????????????????????? ??????????'),
       (17, 'ru', '?????????? ????????????????????????');

SELECT setval('hr_departments_id_seq', max(id))
FROM public.hr_departments;

SELECT setval('hr_department_translations_id_seq', max(id))
FROM public.hr_department_translations;
