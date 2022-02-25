<?php

namespace App\Observers\Master;

use App\Models\User;
use App\Services\Organization\Basic\Employee\EmployeeService;

class UserObserver
{
    protected EmployeeService $employeeService;

    public function __construct(
        EmployeeService $employeeService
    ) {
        $this->employeeService = $employeeService;
    }

    public function created(User $user)
    {
        if (isset($user->email_verified_at)) {
            $data['user_id'] = $user->id;
            $data['email'] = $user->username;
            return $this->employeeService->store($data);
        }
    }

    public function updated(User $user)
    {
        $employee = $this->employeeService->get()->where('user_id', $user->id)->get();
        if (isset($user->email_verified_at)) {
                if (!isset($employee)){
                    $data['user_id'] = $user->id;
                    $data['phone'] = $user->phone;
                    $data['email'] = $user->username;
                    return $this->employeeService->store($data);
                }
        }
    }

    public function deleted(User $user)
    {
        //
    }

    public function restored(User $user)
    {
        //
    }

    public function forceDeleted(User $user)
    {
        //
    }
}
