CREATE OR REPLACE VIEW public.view_hr_departments
AS
SELECT d.id,
       d.parent_id,
       d.department_type_id,
       d.code,
       d.single_block,
       d.block_color,
       d.background_color,
       d.text_color,
       d.sequence,
       d.created_by,
       d.updated_by,
       d.deleted_by,
       d.created_at,
       d.updated_at,
       d.deleted_at,
       dt.id as department_translation_id,
       dt.language_code,
       dt.name,
       vdt.sequence as dt_sequence,
       vdt.language_code as dt_language_code,
       vdt.name as dt_name
FROM hr_departments d
         LEFT JOIN hr_department_translations dt ON d.id = dt.object_id
         LEFT JOIN view_hr_department_types vdt ON d.department_type_id = vdt.id;
