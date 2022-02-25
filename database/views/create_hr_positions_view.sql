CREATE OR REPLACE VIEW public.view_hr_positions
AS
SELECT p.id,
       p.position_type_id,
       p.code,
       p.created_by,
       p.updated_by,
       p.deleted_by,
       p.created_at,
       p.updated_at,
       p.deleted_at,
       pt.id as position_translation_id,
       pt.language_code,
       pt.name
FROM hr_positions p
         LEFT JOIN hr_position_translations pt ON p.id = pt.object_id;
