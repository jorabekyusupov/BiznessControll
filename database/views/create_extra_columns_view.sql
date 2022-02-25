CREATE OR REPLACE VIEW public.view_extra_columns
AS
SELECT ec.id,
       ec.type,
       ec.created_by,
       ec.updated_by,
       ec.created_at,
       ec.updated_at,
       ect.id as extra_column_translation_id,
       ect.language_code,
       ect.name
FROM extra_columns ec
         LEFT JOIN extra_column_translations ect ON ec.id = ect.object_id;
