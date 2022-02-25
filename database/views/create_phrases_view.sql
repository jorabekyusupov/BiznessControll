CREATE OR REPLACE VIEW public.view_phrases
AS
SELECT p.id,
       p.word,
       p.created_by,
       p.updated_by,
       p.deleted_by,
       p.created_at,
       p.updated_at,
       p.deleted_at,
       pt.id as phrase_translation_id,
       pt.language_code,
       pt.translation
FROM phrases p
         LEFT JOIN phrase_translations pt ON p.id = pt.object_id;

