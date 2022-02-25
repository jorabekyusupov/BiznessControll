CREATE OR REPLACE VIEW public.view_hr_employee_staff
AS
SELECT es.id,
       es.employee_id,
       es.staff_id,
       es.is_active,
       es.is_main_staff,
       es.enter_date,
       es.leave_date,
       es.created_by,
       es.updated_by,
       es.deleted_by,
       es.created_at,
       es.updated_at,
       es.deleted_at,
       we.user_id,
       we.phone,
       we.avatar,
       we.email,
       we.born_date,
       we.gender,
       we.first_name,
       we.last_name,
       we.middle_name,
       we.language_code
FROM hr_employee_staff es
         LEFT JOIN view_employees we ON es.employee_id = we.id;
