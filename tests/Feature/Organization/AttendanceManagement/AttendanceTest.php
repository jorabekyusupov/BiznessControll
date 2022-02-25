<?php

namespace Tests\Feature\Organization\AttendanceManagement;

use App\Models\Organization\AttendanceManagement\Attendance\Attendance;
use App\Models\Organization\Basic\Employee\Employee;
use App\Models\User;
use Tests\Feature\OrganizationBase;

class AttendanceTest extends OrganizationBase
{
    public function setUp(): void
    {
        $this->hasTranslation = false;
        $this->modelClass = Attendance::class;
        $this->modelName = 'attendance';
        $this->moduleShort = 'at';

        $this->inOutStructure = [
            'status',
            'message',
            'data' => [
                'id',
                'employee_id',
                'in',
                'out',
                'duration',
                'created_at',
                'updated_at',
            ]
        ];

        $this->singleStructure = [
            'id',
            'employee_id',
            'in',
            'out',
            'duration',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ];

        $this->statusStructure = [
            'status',
            'message',
            'data' => [ 
                'status',
                'last_action' => [
                    'id',
                    'employee_id',
                    'in',
                    'out',
                    'duration',
                    'created_at',
                    'updated_at',
                ],
                'today_actions' => [
                    '*' => [
                        'id',
                        'employee_id',
                        'in',
                        'out',
                        'duration',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]
        ];

        $this->indexStructure = [
            "current_page",
            "data" => [
                '*' => [
                    'id',
                    'employee_id',
                    'in',
                    'out',
                    'duration',
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at',
                ]
            ],
            "first_page_url",
            "from",
            "last_page",
            "last_page_url",
            "links",
            "next_page_url",
            "path",
            "per_page",
            "prev_page_url",
            "to",
            "total"
        ];

        $this->rawData = [
            'employee_id' => 1,
            'in' => time(),
        ];

        parent::setUp();
    }

    // in 

    public function test_can_in()
    {
        $this->user = User::factory()->create();
        Employee::factory()->create(['user_id' => $this->user->id]);

        $this->json("post", $this->route($this->apiUrl . '.in'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->inOutStructure);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_in()
    {
        $this->json("post", $this->route($this->apiUrl . '.in'), $this->rawData)
            ->assertStatus(401);
    }

    public function test_return_not_imlemented_error_when_send_wrong_request_on_in()
    {
        Attendance::factory()->create(['employee_id' => $this->user->employee->id,'out' => null,'duration' => null]);
        $this->json("post", $this->route($this->apiUrl . '.in'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(501)
            ->assertJsonStructure($this->inOutStructure);
    }

    // out 

    public function test_can_out()
    {
        $this->user = User::factory()->create();
        Employee::factory()->create(['user_id' => $this->user->id]);
        Attendance::factory()->create(['employee_id' => $this->user->employee->id,'in' => time() - 10,'out' => null,'duration' => null]);

        $this->json("post", $this->route($this->apiUrl . '.out'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->inOutStructure);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_out()
    {
        $this->json("post", $this->route($this->apiUrl . '.out'), $this->rawData)
            ->assertStatus(401);
    }

    public function test_return_not_found_error_when_send_wrong_request_on_out()
    {
        $this->user = User::factory()->create();
        Employee::factory()->create(['user_id' => $this->user->id]);
        Attendance::factory()->create(['employee_id' => $this->user->employee->id]);

        $this->json("post", $this->route($this->apiUrl . '.out'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(404);
    }



    // status 

    public function test_can_status()
    {
        $this->withoutExceptionHandling();
        $this->user = User::factory()->create();
        Employee::factory()->create(['user_id' => $this->user->id]);
        Attendance::factory()->create(['employee_id' => $this->user->employee->id]);

        $this->json("get", $this->route($this->apiUrl . '.status'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->statusStructure);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_status()
    {
        $this->json("get", $this->route($this->apiUrl . '.status'), $this->rawData)
            ->assertStatus(401);
    }


    // create

    // create da agar header token berilsa va form ma'lumotlari jo'natilsa, 201 qaytishi kerak
    // qaytgan response strukturasi belgilangan strukturaga mos kelishi kk
    // qaytgan response tarkibida jo'natilgan ma'lumotlar bo'lishi kerak
    public function test_can_create_item()
    {
        $this->withExceptionHandling();
        $this->json("post", $this->route($this->apiUrl . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(201);
    }

    // create da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_create()
    {
        $this->json("post", $this->route($this->apiUrl . '.store'), $this->rawData)
            ->assertStatus(401);
    }

    // create da agar required fieldlar jo'natilmasa 422 xato qaytishi kerak
    public function test_return_validation_error_when_required_fields_not_sent_on_create()
    {
        $rawData =  $rawData2 =  $this->rawData;
        unset($rawData['employee_id']);
        unset($rawData2['in']);

        $this->json("post", $this->route($this->apiUrl . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->json("post", $this->route($this->apiUrl . '.store'), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);
    }



    // update

    // update da agar header token berilsa va form ma'lumotlari jo'natilsa, 200 qaytishi kerak
    public function test_can_update_item()
    {
        $model = $this->createModels()[0];

        $rawData = [
            'in' => 9999
        ];

        $this->putJson($this->route($this->apiUrl . '.update', [$this->modelName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // update da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $model = $this->createModels()[0];
        $rawData = [];

        $this->putJson($this->route($this->apiUrl . '.update', [$this->modelName => $model->id]), $rawData)
            ->assertStatus(401);
    }


    // updateda agar required fieldlar jonatilmasa xato qaytishi kerak
    public function test_return_success_without_sending_required_fields_on_update()
    {
        $model = $this->createModels()[0];

        $rawData = [];


        $this->putJson($this->route($this->apiUrl . '.update', [$this->modelName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
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
            $this->modelName => $model->id,
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

        $this->getJson($this->route($this->apiUrl . '.show', [$this->modelName => $model->id]))
            ->assertStatus(401);
    }

    // show da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_show()
    {
        $model = $this->createModels()[0];
        $params = [
            $this->modelName => $model->id + 1,
        ];
        $this->getJson($this->route($this->apiUrl . '.show', $params), $this->getHeadersWithToken())
            ->assertStatus(404);
    }



    // delete

    // delete da agar header token berilsa 204 (NO CONTENT) status qaytishi kerak
    public function test_can_delete_item()
    {
        $model = $this->createModels()[0];

        $this->deleteJson($this->route($this->apiUrl . '.destroy', [$this->modelName => $model->id]), [], $this->getHeadersWithToken())
            ->assertStatus(204);
    }

    // delete da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_delete()
    {
        $model = $this->createModels()[0];

        $this->deleteJson($this->route($this->apiUrl . '.destroy', [$this->modelName => $model->id]))
            ->assertStatus(401);
    }

    // delete da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_delete()
    {
        $model = $this->createModels()[0];
        $this->deleteJson($this->route($this->apiUrl . '.destroy', [$this->modelName => $model->id + 1]), $this->getHeadersWithToken())
            ->assertStatus(404);
    }
}
