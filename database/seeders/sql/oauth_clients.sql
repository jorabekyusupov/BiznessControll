UPDATE public.oauth_clients
SET name = 'Laravel Password Grant Client',
    secret = 'IPRahHhmqyyPHWw1eclDbcQc5TWsjK4yY9gr1US0',
    provider = 'users'
WHERE public.oauth_clients.id = 2;
