<?php

namespace App\Services\Master\UserOrganization;

use App\Services\Service;
use App\Repositories\Master\UserOrganization\UserOrganizationRepository;

class UserOrganizationService extends Service
{
    public function __construct(UserOrganizationRepository $userOrganizationRepository)
    {
        $this->repository = $userOrganizationRepository;
    }

    public function indexUserOrganization($data, $relation = null)
    {
        $user_id = $data['user_id'] ?? null;
        if ($user_id) return $this->get($relation)->where('user_id', $user_id)->get();
        else return $this->getPaginate($data, $relation);
    }

}
