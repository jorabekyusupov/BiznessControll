<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ConfigMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->id()) {
            $db_name = auth()->user()->default_database;
            Config::set('database.connections.byorkit_organization.database', $db_name);
        }
        return $next($request);
    }
}
