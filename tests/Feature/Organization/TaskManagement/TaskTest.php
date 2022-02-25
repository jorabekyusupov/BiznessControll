<?php

namespace Tests\Feature\Organization\Basic;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\TaskManagement\Task\Task;
use App\Models\Organization\TaskManagement\Type\Type;
use App\Models\User;
use Tests\Feature\OrganizationBase;
use Illuminate\Support\Str;

class TaskTest extends OrganizationBase
{
    public function setUp(): void
    {
        $this->modelClass = Task::class;
        $this->modelName = 'task';
        $this->moduleShort = 'tm';

        $this->singleStructure = [
            'id',
            'parent_id',
            'folder_id',
            'type_id',
            'title',
            'is_plan',
            'status_id',
            'expected_result',
            'actual_result',
            'expected_duration',
            'actual_duration',
            'priority_id',
            'description',
            'begin_date',
            'end_date',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
            'deleted_at',
            'type_name',
            'status_name',
            'priority_name',
            'file',
            'sub_task',
            'owner' => [
                'id',
                'relation_type_id',
                'task_id',
                'employee_id',
                'staff_id',
                'expected_duration',
                'actual_duration',
                'begin_date',
                'status_id',
                'name',
                'type',
                'position_name',
                'department_name',
                'user_id',
                'avatar',
                'first_name',
                'last_name',
                'middle_name',
                'language_code',
            ],
            'executors',
            'auditors',
            'watchers',
        ];

        $this->indexStructure = [
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'parent_id',
                    'folder_id',
                    'type_id',
                    'title',
                    'is_plan',
                    'status_id',
                    'expected_result',
                    'actual_result',
                    'expected_duration',
                    'actual_duration',
                    'priority_id',
                    'description',
                    'begin_date',
                    'end_date',
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                    'type_name',
                    'status_name',
                    'priority_name',
                    'owner' => [
                        'id',
                        'relation_type_id',
                        'task_id',
                        'employee_id',
                        'staff_id',
                        'expected_duration',
                        'actual_duration',
                        'begin_date',
                        'status_id',
                        'name',
                        'type',
                        'position_name',
                        'department_name',
                        'user_id',
                        'avatar',
                        'first_name',
                        'last_name',
                        'middle_name',
                        'language_code',
                    ],
                    'executors',
                    'auditors',
                    'watchers',
                    'sub_task',
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
            'parent_id' => null,
            'type_id' => 1,
            'title' => 'This a test task'
        ];

        parent::setUp();
    }

    // create

    public function test_can_create()
    {
        $this->createRelatedModels();
        $this->rawData['type_id'] = $this->relatedModels['type']->id;
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
        unset($data['type_id']);
        unset($data2['title']);
        $this->postJson($this->route($this->apiUrl . '.store'), $data, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->postJson($this->route($this->apiUrl . '.store'), $data2, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // update

    public function test_can_update_item()
    {
        $model = $this->createModels()[0];
        $this->rawData['title'] = $model->title . ' upd';
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



    // reports

    public function test_can_show_report()
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create(['user_id' => $user->id]);
        $params = [
            'group_type' => 1,
            'employee_id' => $employee->id,
        ];
        $this->getJson($this->route('organization.'.$this->moduleShort.'.group',$params), $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_report()
    {
        $this->getJson($this->route('organization.'.$this->moduleShort.'.group'))->assertStatus(401);
    }

    public function test_can_show_report2()
    {
        $this->getJson($this->route('organization.'.$this->moduleShort.'.report'), $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_report2()
    {
        $this->getJson($this->route('organization.'.$this->moduleShort.'.report'))->assertStatus(401);
    }


    protected function createModels($count = 1){

        $this->createRelatedModels();
        $data = [
            'type_id' => $this->relatedModels['type']->id,
        ];
        $models = $this->modelClass::factory($count)->create($data);

        return $models;
    }

    protected function createRelatedModels(){
        $this->relatedModels['type'] = Type::factory()->create();
    }


}
