CREATE
OR REPLACE VIEW public.view_tm_related_employees AS
SELECT re.*,
       rt.name,
       rt.type,
       vs.position_name,
       vs.department_name,
       ve.user_id,
       ve.avatar,
       ve.first_name,
       ve.last_name,
       ve.middle_name,
       ve.language_code

FROM tm_related_employees re
         LEFT JOIN tm_relation_types rt ON re.relation_type_id = rt.id
         LEFT JOIN view_hr_staff vs ON re.staff_id = vs.id
         LEFT JOIN view_employees ve ON re.employee_id = ve.id

