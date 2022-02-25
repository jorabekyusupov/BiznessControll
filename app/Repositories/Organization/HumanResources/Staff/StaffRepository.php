<?php

namespace App\Repositories\Organization\HumanResources\Staff;

use App\Models\Organization\HumanResources\Staff\Staff;
use App\Models\Organization\HumanResources\Staff\ViewStaff;
use App\Models\Organization\HumanResources\Staff\ViewStaffPosition;
use App\Repositories\Repository;

class StaffRepository extends Repository
{
    public function __construct(Staff $staff, ViewStaff $viewStaff, ViewStaffPosition  $viewStaffPosition)
    {
        $this->model = $staff;
        $this->modelView = $viewStaff;
//        $this->modelView = $v
//iewStaffPosition;
    }

}
