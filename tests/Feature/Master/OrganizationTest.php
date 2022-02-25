<?php

namespace Tests\Feature\Master;

use App\Models\Master\Organization;
use Tests\Feature\MasterBase;

class OrganizationTest extends MasterBase
{
    public function setUp(): void
    {
        $this->hasTranslation = false;
        $this->modelName = 'organization';
        $this->modelClass = Organization::class;

        $this->singleStructure = [
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
            'deleted_at'
        ];

        $this->indexStructure = [
            "current_page",
            "data" => [
                '*' => [
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
                    'deleted_at'
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
            'name' => 'ong',
            'db_name' => 'ong',
            'host_name' => 'ong',
            'status' => 0
        ];

        parent::setUp();
    }



    // update

    // update da agar header token berilsa va form ma'lumotlari jo'natilsa, 200 qaytishi kerak
    public function test_can_update_item()
    {
        $model = $this->createModels()[0];

        $rawData = [
            'name' => 'ong2',
            'host_name' => 'ong2',
            'status' => 1
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
    public function test_return_validation_error_without_sending_required_fields_on_update()
    {
        $model = $this->createModels()[0];

        $rawData = [
            'host_name' => $model->hostname,
            'status' => $model->status
        ];
        $rawData2 = [
            'name' => $model->model,
            'status' => $model->status
        ];
        $rawData3 = [
            'name' => $model->model,
            'host_name' => $model->hostname
        ];


        $this->putJson($this->route($this->apiUrl . '.update', [$this->modelName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->putJson($this->route($this->apiUrl . '.update', [$this->modelName => $model->id]), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->putJson($this->route($this->apiUrl . '.update', [$this->modelName => $model->id]), $rawData3, $this->getHeadersWithToken())
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
