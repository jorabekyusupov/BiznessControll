<?php

namespace Tests\Feature\Master;

use App\Models\Master\OrganizationModule;
use Tests\Feature\MasterBase;

class OrganizationModuleTest extends MasterBase
{
    public function setUp(): void
    {
        $this->hasTranslation = false;
        $this->modelName = 'organization-module';
        $this->modelClass = OrganizationModule::class;

        $this->singleStructure = [
            'id',
            'organization_id',
            'module_id',
            'status',
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
                    "organization_id",
                    "module_id",
                    "status",
                    "created_by",
                    "updated_by",
                    "created_at",
                    "updated_at"
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
            'organization_id' => 1,
            'module_id' => 2,
            'status' => false
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
        unset($rawData['organization_id']);
        unset($rawData2['module_id']);
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
        $rawData['organization_id'] = $model->organization_id;
        $rawData['module_id'] = $model->module_id;

        $this->json("post", $this->route($this->apiUrl . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // update

    // update da agar header token berilsa va form ma'lumotlari jo'natilsa, 200 qaytishi kerak
    public function test_can_update_item()
    {
        $model = $this->createModels()[0];
        $rawData = [
            'organization_id' => 31,
            'module_id' => 42,
            'status' => false
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
        $rawData['organization_id'] =  $model->organization_id;
        $rawData['module_id'] =  $model->module_id;

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
