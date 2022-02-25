CREATE
OR REPLACE VIEW public.view_tm_tasks AS
SELECT t.id,
       t.parent_id,
       t.folder_id,
       t.type_id,
       t.title,
       t.is_plan,
       t.status_id,
       t.expected_result,
       t.actual_result,
       t.expected_duration,
       t.actual_duration,
       t.priority_id,
       t.description,
       t.begin_date,
       t.end_date,
       t.created_by,
       t.updated_by,
       t.created_at,
       t.updated_at,
       tt.name  type_name,
       ts.name  status_name,
       tp.name  priority_name

FROM tm_tasks t
         LEFT JOIN tm_types tt ON t.type_id = tt.id
         LEFT JOIN tm_statuses ts ON t.status_id = ts.id
         LEFT JOIN tm_priorities tp ON t.priority_id = tp.id

