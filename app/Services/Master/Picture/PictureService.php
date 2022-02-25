<?php

namespace App\Services\Master\Picture;

use App\Models\Organization\Basic\Employee\Employee;
use App\Services\Master\User\UserService;
use App\Services\Organization\Basic\Employee\EmployeeService;
use App\Services\Service;
use App\Traits\ImageUpload;
use League\Flysystem\FileNotFoundException;
use App\Repositories\Master\Picture\PictureRepository;

class PictureService extends Service
{
    use ImageUpload;

    private EmployeeService $employeeService;

    public function __construct(
        PictureRepository $pictureRepository,
        EmployeeService   $employeeService
    )
    {
        $this->repository = $pictureRepository;
        $this->employeeService = $employeeService;
    }

    public function pictureStore($data, $pictureStoreUpdateRequest)
    {
        $oldPictures = $this->get()->where('object_id', $data['object_id'])
            ->where('object_type', $data['object_type'])->get();
        if ($oldPictures) {
            foreach ($oldPictures as $oldPicture) {
                if ($oldPicture->picture_name) {
                    if (file_exists(storage_path() . '/app/public/master/avatar/' . $oldPicture->picture_name)) {
                        unlink(storage_path() . '/app/public/master/avatar/' . $oldPicture->picture_name);
                    }
                }
                $this->delete($oldPicture->id);
            }
        }
        $picture = $this->userImageUpload($pictureStoreUpdateRequest, '/public/master/avatar');
        $params = array_merge($data, $picture);
        $result = $this->store($params);

        if ($data['object_type'] == 1) {
            $employee = $this->employeeService->get()->where('user_id',$data['object_id'])->first();
            $employee->avatar = $picture['picture_name'];
            $employee->save();
        }

        return $result;
    }

    public function pictureShow($id)
    {
        $file = $this->get()->where('object_id', $id)->where('object_type', 1)->latest()->first();
        if ($file) {
            try {
                $path = storage_path() . '/app/public/master/avatar/' . $file->picture_name;
                return response()->file($path);
            } catch (FileNotFoundException $error) {
                return response()->json($error->getMessage(), 404);
            }
        } else {
            return response()->file(public_path() . '/images/no-avatar.png');
        }
    }

}
