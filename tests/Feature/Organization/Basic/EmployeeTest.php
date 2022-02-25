<?php

namespace Tests\Feature\Organization\Basic;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\Basic\Employee\EmployeeTranslation;
use App\Models\User;
use Tests\Feature\OrganizationBase;

class EmployeeTest extends OrganizationBase
{
    public function setUp(): void
    {
        $this->hasTranslation = true;
        $this->modelClass = Employee::class;
        $this->modelTranslationClass = EmployeeTranslation::class;
        $this->modelName = 'employee';
        $this->moduleShort = '';

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
            'user_id',
            'nationality_id',
            'born_date',
            'gender',
            'first_work_date',
            'leave_date',
            'contract_number',
            'contract_date',
            'phone',
            'email',
            'telegram',
            'avatar',
            'note',
            'responsible_id',
            'is_active',
            'is_accessible',
            'inn',
            'inps',
            'created_by',
            'updated_by',
            'deleted_by',
            'deleted_at',
            'created_at',
            'updated_at',
            'translations',
            'user',
            'employee_staff',
            'user_organizations',
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
                    'user_id',
                    'nationality_id',
                    'born_date',
                    'gender',
                    'first_work_date',
                    'leave_date',
                    'contract_number',
                    'contract_date',
                    'phone',
                    'telegram',
                    'avatar',
                    'email',
                    'note',
                    'responsible_id',
                    'is_active',
                    'is_accessible',
                    'inn',
                    'inps',
                    'created_by',
                    'updated_by',
                    'deleted_by',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                    'employee_translation_id',
                    'language_code',
                    'first_name',
                    'last_name',
                    'middle_name',
                    'user',
                    'employee_staff',
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

        $this->employeeData = [
            'username' => 'someuser@email.com',
            'name' => 'Some username',
            'password' => 'sOmepass',
            'permission_user' => '',
            'translations' => [
                'language_code' => 'uz',
                'first_name' => 'name trans in uzb',
            ]
        ];

        $this->employeeUpdated = [
            'id',
            'username',
            'name',
            'phone',
            'default_database',
            'language_code',
            'verification_token',
            'email_verified_at',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ];

        $this->employeeCreated = [
            'username',
            'name',
            'phone',
            'email_verified_at',
            'default_database',
            'updated_at',
            'created_at',
            'id',
        ];

        $this->updateEmployeeData = [
            'nationality_id' => 2,
            'user_id' => 2,
            'born_date' => '01/01/2022',
            'gender' => 2,
            'first_work_date' => '01/01/2022',
            'leave_date' => '02/02/2022',
            'contract_number' => 'uz',
            'contract_date' => '01/01/2022',
            'is_active' => 2,
            'inn' => 123456789,
            'inps' => 12345678901234,
            'phone' => '+998971234567',
            'telegram' => '@byork',
            'note' => 'byork',
            'responsible_id' => 1,
            'employee_main_staff_id' => 2,
            'translations' => [
                'first_name' => 'Hasdka',
                'last_name' => 'Lksjhfk',
                'language_code' => 'uz'
            ]
        ];

        $this->updateEmployeeResponceStructure = [
            'id',
            'user_id',
            'nationality_id',
            'born_date',
            'gender',
            'first_work_date',
            'leave_date',
            'contract_number',
            'contract_date',
            'phone',
            'email',
            'telegram',
            'avatar',
            'note',
            'responsible_id',
            'is_active',
            'is_accessible',
            'inn',
            'inps',
            'created_by',
            'updated_by',
            'deleted_by',
            'deleted_at',
            'created_at',
            'updated_at',
        ];

        parent::setUp();
    }

    // create employee

    public function test_can_create_user_and_employee()
    {
        $this->postJson($this->route('organization.employee_add'), $this->employeeData, $this->getHeadersWithToken())
            ->assertStatus(201)
            ->assertJsonStructure($this->employeeCreated);
    }

    public function test_can_update_user_and_create_employee()
    {
        $user = User::factory()->create();
        $this->employeeData['username'] = $user->username;
        $this->postJson($this->route('organization.employee_add'), $this->employeeData, $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->employeeUpdated);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_create_employee()
    {
        $this->postJson($this->route('organization.employee_add'), $this->employeeData)->assertStatus(401);
    }

    public function test_return_validation_error_when_required_fields_not_send_on_create_employee()
    {
        $data = $data1 = $this->employeeData;
        unset($data['username']);
        unset($data1['password']);
        $this->postJson($this->route('organization.employee_add'), $data, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->postJson($this->route('organization.employee_add'), $data1, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // update

    public function test_can_update_item()
    {
        $model = $this->createModels()[0];

        $this->updateEmployeeData['user_id'] = $model->user_id;
        $this->updateEmployeeData['phone'] = '+998901234567';

        $this->putJson($this->route($this->apiUrl . '.update', [$this->modelName => $model->id]), $this->updateEmployeeData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $model = $this->createModels()[0];
        $this->putJson($this->route($this->apiUrl . '.update', [$this->modelName => $model->id]), [])
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
            ->assertStatus(200);
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

    protected function createModels($count = 1){

        $user = User::factory()->create();
        $models = $this->modelClass::factory($count)->create(['user_id' => $user->id]);
        
        if($this->hasTranslation){
            $models->each(function ($model) {
                $this->modelTranslationClass::factory()->create(['object_id' => $model->id, 'language_code' => 'uz']);
                $this->modelTranslationClass::factory()->create(['object_id' => $model->id, 'language_code' => 'en']);
                $this->modelTranslationClass::factory()->create(['object_id' => $model->id, 'language_code' => 'ru']);
            });
        }

        return $models;
    }


}
