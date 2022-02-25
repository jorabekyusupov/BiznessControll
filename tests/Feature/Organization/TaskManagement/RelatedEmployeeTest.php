<?php

namespace Tests\Feature\Organization\Basic;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\HumanResources\Department\Department;
use App\Models\Organization\TaskManagement\RelatedEmployee\RelatedEmployee;
use App\Models\Organization\TaskManagement\RelationType\RelationType;
use App\Models\Organization\TaskManagement\Status\Status;
use App\Models\Organization\TaskManagement\Tag\Tag;
use App\Models\Organization\TaskManagement\Task\Task;
use App\Models\User;
use Tests\Feature\OrganizationBase;
use Illuminate\Support\Str;

class RelatedEmployeeTest extends OrganizationBase
{
    public function setUp(): void
    {
        $this->modelClass = RelatedEmployee::class;
        $this->modelName = 'related-employee';
        $this->moduleShort = 'tm';

        $this->singleStructure = [
            'id',
            'relation_type_id',
            'task_id',
            'employee_id',
            'staff_id',
            'expected_duration',
            'actual_duration',
            'begin_date',
            'status_id',
        ];

        $this->indexStructure = [
            'current_page',
            'data' => [
                '*' => $this->singleStructure
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
            'relation_type_id' => 1,
            'task_id' => 1,
            'employee_id' => 1,
            'begin_date' => null,
            'status_id' => 1
        ];

        parent::setUp();
    }

    // create

    public function test_can_create()
    {
        $this->createRelatedModels();
        $this->rawData['task_id'] = $this->relatedModels['task']->id;
        $this->rawData['employee_id'] = $this->relatedModels['employee']->id;
        $this->rawData['relation_type_id'] = $this->relatedModels['relation_type']->id;
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(201);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_create()
    {
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData)->assertStatus(401);
    }

    public function test_return_validation_error_when_required_fields_not_send_on_create()
    {
        $data = $data2 = $data3 = $this->rawData;
        unset($data['task_id']);
        unset($data2['employee_id']);
        unset($data3['relation_type_id']);
        $this->postJson($this->route($this->apiUrl . '.store'), $data, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->postJson($this->route($this->apiUrl . '.store'), $data2, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->postJson($this->route($this->apiUrl . '.store'), $data3, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // update

    public function test_can_update_item()
    {
        $model = $this->createModels()[0];
        $this->rawData['begin_date'] = date('d-m-Y H:i');
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


    protected function createModels($count = 1){

        $this->createRelatedModels();
        $data = [
            'relation_type_id' => $this->relatedModels['relation_type']->id,
            'task_id' => $this->relatedModels['task']->id,
            'employee_id' => $this->relatedModels['employee']->id,
            'status_id' => $this->relatedModels['status']->id,
        ];
        $models = $this->modelClass::factory($count)->create($data);

        return $models;
    }

    protected function createRelatedModels(){
        $this->relatedModels['task'] = Task::factory()->create();
        $this->relatedModels['user'] = User::factory()->create();
        $this->relatedModels['employee'] = Employee::factory()->create(['user_id' => $this->relatedModels['user']->id]);
        $this->relatedModels['status'] = Status::factory()->create();
        $this->relatedModels['relation_type'] = RelationType::factory()->create();
    }


}