<?php

namespace App\Services\Master\User;

use App\Services\Organization\Basic\Employee\EmployeeService;
use App\Services\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use App\Repositories\Master\User\UserRepository;

class UserService extends Service
{


    private EmployeeService $employeeService;

    public function __construct(UserRepository $userRepository, EmployeeService $employeeService)
    {
        $this->repository = $userRepository;
        $this->employeeService = $employeeService;
    }

    public function seeder($db_name)
    {
        try {
            DB::unprepared('create database "' . $db_name . '"');
            Config::set('database.connections.byorkit_organization.database', $db_name);
            Artisan::call('migrate:fresh', [
                '--path' => 'database/migrations/Organization',
                '--database' => 'byorkit_organization'
            ]);
            return [
                'Successfully',
            ];
        } catch (\Throwable $throwable) {
            return [
                $throwable->getMessage(),
            ];
        }
    }

    public function verify($token)
    {
        $user = $this->get()->where('verification_token', $token)->first();
        if ($user) {
            if (!$user->email_verified_at) {
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                $user->default_database = env('DB_PREFIX', 'boshqaruv') . '_' . substr(str_shuffle($permitted_chars), 0, 8);
                $this->seeder($user->default_database);
                $user->email_verified_at = now();
                $user->save();
                $data['user_id'] = $user->id;
                $data['email'] = $user->username;
                $this->employeeService->store($data);
                return $user;
            } else {
                return response('User already verified!');
            }
        } else {
            return response('Not found', 404);
        }

    }

    public function employeeStore($data)
    {
        $data['password'] = bcrypt($data['password']);
        $data['phone'] = '000';
        $data['email_verified_at'] = now();
        $data['default_database'] = auth()->user()->default_database;
        $user = $this->get()->where('username', $data['username'])->first();
        if ($user) {
            unset($data['default_database']);
            return $this->edit($user->id, $data);
        } else {
            return $this->store($data);
        }
    }

    public function resetPassword($id, $data)
    {
        $model = $this->get()->find($id);
        $old_password = bcrypt($data['old_password']);
        if (\Hash::check($data['old_password'], $model->password)) {
            $data['password'] = bcrypt($data['password']);
            return $this->edit($id, $data);
        } else {
            return response()->noContent();
        }
    }
}
