CREATE OR REPLACE VIEW public.view_user_organizations
AS
SELECT uo.*,
       o.name,
       o.host_name,
       o.status
FROM user_organizations uo
         LEFT JOIN organizations o ON uo.organization_id = o.id;
