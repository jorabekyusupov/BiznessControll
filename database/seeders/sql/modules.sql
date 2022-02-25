INSERT INTO public.modules (name, icon_name, module_link, icon_type)
VALUES ('company', 'company.svg', '/company', 2),
       ('admin', 'admin.svg', '/admin', 2),
       ('task_management', 'Tasks.svg', '/tm', 2);

SELECT setval('modules_id_seq', max(id))
FROM public.modules;
