<?php

namespace Tests\Feature\Master;

use App\Models\Master\UserOrganization;
use Tests\Feature\MasterBase;

class UserOrganizationTest extends MasterBase
{
    public function setUp(): void
    {
        $this->hasTranslation = false;
        $this->modelName = 'user-organization';
        $this->modelClass = UserOrganization::class;

        $this->singleStructure = [
            'id',
            'user_id',
            'organization_id',
            'updated_at',
            'created_at'
        ];

        $this->indexStructure1 = [
                '*' => [
                    'id',
                    'user_id',
                    'organization_id',
                    'updated_at',
                    'created_at'
                ]
        ];

        $this->indexStructure2 = [
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'user_id',
                    'organization_id',
                    'created_at',
                    'updated_at',
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
            'user_id' => 1,
            'organization_id' => 2
        ];

        parent::setUp();
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
        $rawData = $rawData2 = $this->rawData;
        unset($rawData['user_id']);
        unset($rawData2['organization_id']);
        $this->json("post", $this->route($this->apiUrl . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->json("post", $this->route($this->apiUrl . '.store'), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // create da unique fieldarni qayta post qilinsa xato qaytishi kerak
    public function test_return_validation_error_when_send_dublicate_data_on_create()
    {
        $model = $this->createModels()[0];
        $rawData = $this->rawData;
        $rawData['user_id'] = $model->module_id;
        $rawData['organization_id'] = $model->organization_id;

        $this->json("post", $this->route($this->apiUrl . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // update

    // update da agar header token berilsa va form ma'lumotlari jo'natilsa, 200 qaytishi kerak
    public function test_can_update_item()
    {
        $model = $this->createModels()[0];
        $rawData = [
            "user_id" => 3,
            "organization_id" => 4
        ];

        $this->putJson($this->route($this->apiUrl . '.update', [$model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // update da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $model = $this->createModels()[0];
        $rawData = [];

        $this->putJson($this->route($this->apiUrl . '.update', [$model->id]), $rawData)
            ->assertStatus(401);
    }

    // updateda agar unique fieldlarni o'zgartirmasdan jo'natilsa xato qaytmasligi kerak
    public function test_can_update_item_with_not_changed_unique_fields_on_update()
    {
        $model = $this->createModels()[0];
        // dd($model);
        $rawData['user_id'] =  $model->user_id;
        $rawData['organization_id'] =  $model->organization_id;

        $this->putJson($this->route($this->apiUrl . '.update', [$model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // updateda agar required fieldlar jonatilmasa xato qaytishi kerak
    public function test_return_validation_error_without_sending_required_fields_on_update()
    {
        $model = $this->createModels()[0];

        $rawData = [];


        $this->putJson($this->route($this->apiUrl . '.update', [$model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }


    // index

    // index da agar headerda token berilsa,
    // required param bo'lgan language berilsa,
    // 200 qaytishi kerak
    public function test_can_index_items()
    {

        $this->createModels(1);
        $this->getJson($this->route($this->apiUrl . '.index', ['user_id' => $this->user->id]), $this->getHeadersWithToken())
        ->assertJsonStructure($this->indexStructure1)
        ->assertStatus(200);
        
        $this->getJson($this->route($this->apiUrl . '.index'), $this->getHeadersWithToken())
            ->assertJsonStructure($this->indexStructure2)
            ->assertStatus(200);
    }

    // index da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_index()
    {
        $this->createModels(1);

        $this->getJson($this->route($this->apiUrl . '.index', ['search' => '']))
            ->assertStatus(401);
    }


    // delete

    // delete da agar header token berilsa 204 (NO CONTENT) status qaytishi kerak
    public function test_can_delete_item()
    {
        $model = $this->createModels()[0];

        $this->deleteJson($this->route($this->apiUrl . '.destroy', [$model->id]), [], $this->getHeadersWithToken())
            ->assertStatus(204);
    }

    // delete da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_delete()
    {
        $model = $this->createModels()[0];

        $this->deleteJson($this->route($this->apiUrl . '.destroy', [$model->id]))
            ->assertStatus(401);
    }

    // delete da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_delete()
    {
        $model = $this->createModels()[0];
        $this->deleteJson($this->route($this->apiUrl . '.destroy', [$model->id + 1]), $this->getHeadersWithToken())
            ->assertStatus(404);
    }
}
