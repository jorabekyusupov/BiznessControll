<?php

namespace Tests\Feature\Master;

use App\Models\User;
use Laravel\Passport\Passport;
use Tests\Feature\MasterBase;

class UserTest extends MasterBase
{
    public function setUp(): void
    {
        $this->hasTranslation = false;
        $this->modelName = 'user';
        $this->modelClass = User::class;

        $this->profileStructure = [
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
            'organization' => [
                'id',
                'name',
                'db_name',
                'host_name',
                'status',
                'created_by',
                'updated_by',
                'deleted_by',
                'created_at',
                'updated_at',
                'deleted_at',
            ],
            'view_employee' => [
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
            ],
            'language'
        
        ];
        
        $this->singleStructure = [
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
            'updated_at'
        ];

        $this->indexStructure = [
            "current_page",
            "data" => [
                '*' => [
                    "id",
                    "name",
                    "icon_name",
                    "module_link",
                    "icon_type",
                    "updated_at",
                    "created_at"

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
            'username' => 'zbadalboyev@gmail.com',
            'name' => 'Zafar',
            'phone' => '+998914860882',
            'hostname' => 'http://127.0.0.1:8000',
        ];

        $this->updateData = [
            'phone' => '+998914860882',
            'language_code' => 'en'
        ];

        $this->resetData = [
            'old_password' => 'byork!@#$%',
            'password' =>  '998998118787',
            'password_confirm' =>  '998998118787'
        ];

        $this->verifyStructure = [
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


        

        parent::setUp();
    }

    // register

    public function test_can_register_item_xxx()
    {
        $this->withoutExceptionHandling();
        $this->json("post", $this->route('register'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
        
        // regsiterda email ga jo'natadigan qism bor shuni test qilishni ko'rish kk
        // $this->assertTrue(true);
    }

    // profile

    public function test_can_show_profile()
    {
        $data = [
            'id' => $this->user->id,
        ];

        $this->getJson($this->route('profile'), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->profileStructure)
            ->assertJsonFragment($data);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_profile()
    {
        $this->getJson($this->route('profile'))->assertStatus(401);
    }


    // update

    public function test_can_update_item()
    {
        $model = $this->createModels()[0];

        $this->putJson($this->route($this->apiUrl . '.update', ['id' => $model->id]), $this->updateData, $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->singleStructure);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $model = $this->createModels()[0];
        $this->putJson($this->route($this->apiUrl . '.update', ['id' => $model->id]))->assertStatus(401);
    }

    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_update()
    {
        $model = $this->createModels()[0];
        $this->putJson($this->route($this->apiUrl . '.update', ['id' => $model->id + time()]),[], $this->getHeadersWithToken())->assertStatus(404);
    }


    // reset password

    public function test_can_reset_password()
    {
        $model = $this->createModels()[0];
        $this->putJson($this->route('master.password.update', ['id' => $model->id]), $this->resetData, $this->getHeadersWithToken())
            ->assertStatus(204);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_reset_password()
    {
        $model = $this->createModels()[0];
        $this->putJson($this->route('master.password.update', ['id' => $model->id]), $this->resetData)
            ->assertStatus(401);
    }

    public function test_return_validation_error_without_sending_required_fields_on_reset_password()
    {
        $model = $this->createModels()[0];
        $resetData = $resetData2 = $resetData3 = $resetData4 = $this->resetData;
        unset($resetData['old_password']);
        unset($resetData2['password']);
        unset($resetData3['password_confirm']);
        $resetData4['password_confirm'] = $resetData4['password_confirm'] . '_xxx';

        $this->putJson($this->route('master.password.update', ['id' => $model->id]), $resetData, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->putJson($this->route('master.password.update', ['id' => $model->id]), $resetData2, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->putJson($this->route('master.password.update', ['id' => $model->id]), $resetData3, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->putJson($this->route('master.password.update', ['id' => $model->id]), $resetData4, $this->getHeadersWithToken())
            ->assertStatus(422);
    }


    // verify

    public function test_can_verify_xxx()
    {
        $user = User::factory()->create();
        $token = $user->verification_token;
        $this->json("get", $this->route('verify',['token' => $token]))
            ->assertStatus(200)
            ->assertJsonStructure($this->verifyStructure);

        // verify da seeder da muammo bolyapti, transaction ni o'chirib qoyilsa keyin ishlayapti
        // $this->assertTrue(true);
    }

    public function test_return_validation_error_when_token_not_send_on_verify()
    {
        $this->json("get", $this->route('verify'))->assertStatus(422);
    }

    public function test_return_not_found_error_when_token_is_wrong_on_verify()
    {
        $user = User::factory()->create();
        $token = $user->verification_token . '_xxxx';
        $this->json("get", $this->route('verify',['token' => $token]))->assertStatus(404);
    }

    public function test_return_already_verified_message_on_verify_xxx()
    {
        // bu test bazi bazida xato beryapti 
        $user = User::factory()->create(['email_verified_at' => time()]);
        $this->json("get", $this->route('verify',['token' => $user->verification_token]))->assertStatus(200);
    }





    
}
