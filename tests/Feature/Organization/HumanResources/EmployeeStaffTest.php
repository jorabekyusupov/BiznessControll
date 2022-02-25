<?php

namespace Tests\Feature\Organization\Basic;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\HumanResources\Department\Department;
use App\Models\Organization\HumanResources\DepartmentType\DepartmentType;
use App\Models\Organization\HumanResources\EmployeeStaff\EmployeeStaff;
use App\Models\Organization\HumanResources\Staff\Staff;
use App\Models\User;
use Tests\Feature\OrganizationBase;

class EmployeeStaffTest extends OrganizationBase
{
    public function setUp(): void
    {
        $this->modelClass = EmployeeStaff::class;
        $this->modelName = 'employee-staff';
        $this->moduleShort = 'hr';

        $this->singleStructure = [
            'id',
            'employee_id',
            'staff_id',
            'is_active',
            'is_main_staff',
            'enter_date',
            'leave_date',
            'created_by',
            'updated_by',
            'deleted_by',
            'deleted_at',
            'created_at',
            'updated_at',
        ];

        $this->indexStructure = [
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'employee_id',
                    'staff_id',
                    'is_active',
                    'is_main_staff',
                    'enter_date',
                    'leave_date',
                    'created_by',
                    'updated_by',
                    'deleted_by',
                    'deleted_at',
                    'created_at',
                    'updated_at',
                    'staff'
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total',
        ];

        $this->rawData = [
            'employee_id' => 1,
            'staff_id' => 1,
            'is_active' => 1,
            'is_main_staff' => 1,
            'enter_date' => '12.12.2021'
        ];

        parent::setUp();
    }

    // create

    public function test_can_create()
    {
        $this->createRelatedModels();
        $this->rawData['employee_id'] = $this->relatedModels['employee']->id;
        $this->rawData['staff_id'] = $this->relatedModels['staff']->id;
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(201);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_create()
    {
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData)->assertStatus(401);
    }

    public function test_return_validation_error_when_required_fields_not_send_on_create()
    {
        $data = $data2 = $this->rawData;
        unset($data['employee_id']);
        unset($data2['staff_id']);
        $this->postJson($this->route($this->apiUrl . '.store'), $data, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->postJson($this->route($this->apiUrl . '.store'), $data2, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // update

    public function test_can_update_item()
    {
        $model = $this->createModels()[0];

        $this->putJson($this->route($this->apiUrl . '.update', [$this->paramName => $model->id]), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $model = $this->createModels()[0];
        $this->putJson($this->route($this->apiUrl . '.update', [$this->paramName => $model->id]), [])
            ->assertStatus(401);
    }


    // index

    // index da agar headerda token berilsa,
    // required param bo'lgan language berilsa,
    // 200 qaytishi kerak
    public function test_can_index_items()
    {
        $this->createModels(1);

        $this->getJson($this->route($this->apiUrl . '.index', ['search' => '']), $this->getHeadersWithToken())
            ->assertJsonStructure($this->indexStructure)
            ->assertStatus(200);
    }

    // index da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_index()
    {
        $this->createModels(1);

        $this->getJson($this->route($this->apiUrl . '.index', ['search' => '']))
            ->assertStatus(401);
    }


    // show

    // show da agar header token berilsa 200 qaytishi kerak
    // qaytgan response strukturasi belgilangan strukturaga mos kelishi kk
    // qaytgan response tarkibida jo'natilgan ma'lumotlar bo'lishi kerak
    public function test_can_show_item()
    {
        $model = $this->createModels()[0];

        $data = [
            'id' => $model->id,
        ];

        $params = [
            $this->paramName => $model->id,
        ];

        $this->getJson($this->route($this->apiUrl . '.show', $params), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->singleStructure)
            ->assertJsonFragment($data);
    }

    // show da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_show()
    {
        $model = $this->createModels()[0];

        $this->getJson($this->route($this->apiUrl . '.show', [$this->paramName => $model->id]))
            ->assertStatus(401);
    }

    // show da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_show()
    {
        $model = $this->createModels()[0];
        $params = [
            $this->paramName => $model->id + 1,
        ];
        $this->getJson($this->route($this->apiUrl . '.show', $params), $this->getHeadersWithToken())
            ->assertStatus(404);
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

    // delete da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_delete()
    {
        $model = $this->createModels()[0];
        $this->deleteJson($this->route($this->apiUrl . '.destroy', [$this->paramName => $model->id + 1]), $this->getHeadersWithToken())
            ->assertStatus(404);
    }


    protected function createModels($count = 1){

        $this->createRelatedModels();
        $data = [
            'employee_id' => $this->relatedModels['employee']->id,
            'staff_id' => $this->relatedModels['staff']->id
        ];
        $models = $this->modelClass::factory($count)->create($data);

        return $models;
    }

    protected function createRelatedModels(){

        $this->relatedModels['user'] = User::factory()->create();
        $this->relatedModels['employee'] = Employee::factory()->create(['user_id' => $this->relatedModels['user']->id]);
        $this->relatedModels['department'] = Department::factory()->create();
        $this->relatedModels['staff'] = Staff::factory()->create(['department_id' => $this->relatedModels['department']->id]);

    }


}
