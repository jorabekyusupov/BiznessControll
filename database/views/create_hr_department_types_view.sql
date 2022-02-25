CREATE OR REPLACE VIEW public.view_hr_department_types
AS
SELECT dt.id,
       dt.sequence,
       dt.created_by,
       dt.updated_by,
       dt.created_at,
       dt.updated_at,
       dtt.id as department_type_translation_id,
       dtt.language_code,
       dtt.name
FROM hr_department_types dt
         LEFT JOIN hr_department_type_translations dtt ON dt.id = dtt.object_id;

