insert into public.tm_history_types (name)
values ('title'),
       ('owner'),
       ('task_type'),
       ('status'),
       ('employee_status'),
       ('priority'),
       ('parent_id'),
       ('executor'),
       ('auditor'),
       ('watcher'),
       ('folder'),
       ('description'),
       ('attachments'),
       ('expected_result'),
       ('actual_result'),
       ('expected_duration'),
       ('actual_duration'),
       ('begin_date'),
       ('end_date'),
       ('task_file'),
       ('tasK_comment_file');

SELECT setval('tm_history_types_id_seq', max(id))
FROM public.tm_history_types;
