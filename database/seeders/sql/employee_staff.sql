insert into hr_employee_staff (id, employee_id, staff_id, is_main_staff, enter_date)
values (1, 1, 1, 1, now());

SELECT setval('hr_employee_staff_id_seq', max(id))
FROM public.hr_employee_staff;
