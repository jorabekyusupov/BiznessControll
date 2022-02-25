CREATE OR REPLACE VIEW public.view_hr_staff
AS
SELECT s.id,
       s.department_id,
       s.position_id,
       s.is_active,
       s.created_by,
       s.updated_by,
       s.deleted_by,
       s.created_at,
       s.updated_at,
       s.deleted_at,
       vp.position_type_id,

       vp.code          as position_code,
       vp.language_code as position_language_code,
       vp.name          as position_name,

       vd.name          as department_name,
       vd.dt_name       as department_type_name,
       vd.code          as department_code,
       vd.language_code as department_language_code,
       vd.parent_id,
       vd.sequence


FROM hr_staff s
         LEFT JOIN view_hr_positions vp ON s.position_id = vp.id
         LEFT JOIN view_hr_departments vd ON s.department_id = vd.id;
