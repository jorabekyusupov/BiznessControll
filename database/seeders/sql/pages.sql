INSERT INTO public.pages (name, module_id, page_link, page_icon, icon_type)
VALUES ('position', 1, '/company/position', NULL, 1),
       ('org_schema', 1, '/company/org-schema', NULL, NULL),
       ('employees', 1, '/company/staff', NULL, NULL),
       ('plan', 3, '/tm/plan', NULL, NULL),
       ('home', 3, '/tm/home', NULL, NULL),
       ('page', 2, '/admin/page', 'mdi mdi-book-open-page-variant-outline', 1),
       ('language', 2, '/admin/languages', 'mdi mdi-translate', 1),
       ('phrase', 2, '/admin/phrase', 'mdi mdi-file-word', 1),
       ('module', 2, '/admin/modules', 'mdi mdi-application-settings-outline', 1),
       ('nationality', 2, '/admin/nationality', 'mdi mdi-earth', 1),
       ('permission', 2, '/admin/permission', 'mdi mdi-account-lock-outline', 1),
       ('organization_module', 2, '/admin/organization-module', 'mdi mdi-application-brackets', 1),
       ('user_organization', 2, '/admin/user-organization', 'mdi mdi-card-account-details-outline', 1),
       ('organizations_list', 2, '/admin/organizations-list', 'mdi mdi-factory', 1);


SELECT setval('pages_id_seq', max(id))
FROM public.pages;
