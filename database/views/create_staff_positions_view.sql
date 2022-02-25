CREATE OR REPLACE VIEW public.view_staff_positions
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
       vp.code,
       vp.language_code,
       vp.name
FROM hr_staff s
         LEFT JOIN view_hr_positions vp ON s.position_id = vp.id;
