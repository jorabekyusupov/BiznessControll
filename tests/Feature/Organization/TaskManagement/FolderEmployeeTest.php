<?php

namespace Tests\Feature\Organization\Basic;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\TaskManagement\Folder\Folder;
use App\Models\Organization\TaskManagement\FolderEmployee\FolderEmployee;
use App\Models\User;
use Tests\Feature\OrganizationBase;

class FolderEmployeeTest extends OrganizationBase
{
    public function setUp(): void
    {
        $this->modelClass = FolderEmployee::class;
        $this->modelName = 'folder-employee';
        $this->moduleShort = 'tm';

        $this->rawData = [
            'employee_id' => 1,
            'folder_id' => 1,
        ];

        parent::setUp();
    }

    // create

    public function test_can_create()
    {
        $this->createRelatedModels();
        $this->rawData['folder_id'] = $this->relatedModels['folder']->id;
        $this->rawData['employee_id'] = $this->relatedModels['employee']->id;
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(201);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_create()
    {
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData)->assertStatus(401);
    }




    // delete

    // delete da agar header token berilsa 204 (NO CONTENT) status qaytishi kerak
    public function test_can_delete_item()
    {
        $model = $this->createModels()[0];

        $this->deleteJson($this->route($this->apiUrl . '.destroy', [$this->paramName => $model->id]), [], $this->getHeadersWithToken())
            ->assertStatus(204);
    }

    // delete da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_delete()
    {
        $model = $this->createModels()[0];

        $this->deleteJson($this->route($this->apiUrl . '.destroy', [$this->paramName => $model->id]))
            ->assertStatus(401);
    }

    protected function createModels($count = 1){

        $this->createRelatedModels();
        $data = [
            'employee_id' => $this->relatedModels['employee']->id,
            'folder_id' => $this->relatedModels['folder']->id,
        ];
        $models = $this->modelClass::factory($count)->create($data);

        return $models;
    }

    protected function createRelatedModels(){
        $this->relatedModels['folder'] = Folder::factory()->create();
        $this->relatedModels['user'] = User::factory()->create();
        $this->relatedModels['employee'] = Employee::factory()->create(['user_id' => $this->relatedModels['user']->id]);
    }


}
