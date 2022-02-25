<?php

namespace Tests\Feature\Organization\Basic;

use App\Models\Organization\HumanResources\Department\Department;
use App\Models\Organization\HumanResources\Department\DepartmentTranslation;
use App\Models\Organization\HumanResources\DepartmentType\DepartmentType;
use Tests\Feature\OrganizationBase;

class DepartmentTest extends OrganizationBase
{
    public function setUp(): void
    {
        $this->hasTranslation = true;
        $this->modelClass = Department::class;
        $this->modelTranslationClass = DepartmentTranslation::class;
        $this->modelName = 'department';
        $this->moduleShort = 'hr';

        $this->singleStructure = [
            'id',
            'parent_id',
            'department_type_id',
            'sequence',
            'single_block',
            'block_color',
            'background_color',
            'text_color',
            'code',
            'created_by',
            'updated_by',
            'deleted_by',
            'created_at',
            'updated_at',
            'deleted_at',
            'translations' => [
                '*' => [
                    'id',
                    'object_id',
                    'language_code',
                    'name',
                ]
            ],
            'department_extra_columns' => [
                '*' => [
                    'id',
                    'department_id',
                    'extra_column_id',
                    'value',
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at',
                    'extra_columns' => [
                        'id',
                        'type',
                        'created_by',
                        'updated_by',
                        'created_at',
                        'updated_at',
                        'extra_column_translation_id',
                        'language_code',
                        'name',
                    ]
                ]
            ],
        ];

        $this->indexStructure = [
            'data' => [
                '*' => [
                    'id',
                    'parent_id',
                    'department_type',
                    'sequence',
                    'single_block',
                    'block_color',
                    'background_color',
                    'text_color',
                    'department_translation_id',
                    'code',
                    'language_code',
                    'name',
                    'dt_sequence',
                    'dt_language_code',
                    'dt_name',
                ]
            ],
        ];

        $this->treeStructure = [
            'id',
            'parent_id',
            'department_type_id',
            'code',
            'single_block',
            'block_color',
            'background_color',
            'text_color',
            'sequence',
            'created_by',
            'updated_by',
            'deleted_by',
            'created_at',
            'updated_at',
            'deleted_at',
            'department_translation_id',
            'language_code',
            'name',
            'dt_sequence',
            'dt_language_code',
            'dt_name',
            'children',
            'staff',
            'department_extra_columns',
        ];

        $this->rawData = [
            'parent_id' => 60,
            'department_type_id' => 60,
            'code' => '9336',
            'translations' => [
                [
                    'language_code' => 'ru',
                    'name' => 'Department ru'
                ],
                [
                    'language_code' => 'uz',
                    'name' => 'Department uz'
                ]
            ]
        ];

        parent::setUp();
    }

    // create

    public function test_can_create()
    {
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_create()
    {
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData)->assertStatus(401);
    }

    public function test_return_validation_error_when_required_fields_not_send_on_create()
    {
        $data = $data2 = $this->rawData;
        unset($data['department_type_id']);
        unset($data2['code']);
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



    // tree

    public function test_can_tree()
    {
        $this->getJson($this->route('organization.'.$this->moduleShort.'.tree_department'), $this->getHeadersWithToken())
            ->assertJsonStructure($this->treeStructure)
            ->assertStatus(200);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_tree()
    {
        $this->getJson($this->route('organization.'.$this->moduleShort.'.tree_department'))->assertStatus(401);
    }


    protected function createModels($count = 1){
        $this->createRelatedModels();
        $data = [
            'department_type_id' => $this->relatedModels['department_type']->id
        ];
        $models = $this->modelClass::factory($count)->create($data);

        $models->each(function ($model) {
            $this->modelTranslationClass::factory()->create(['object_id' => $model->id, 'language_code' => 'uz']);
            $this->modelTranslationClass::factory()->create(['object_id' => $model->id, 'language_code' => 'en']);
            $this->modelTranslationClass::factory()->create(['object_id' => $model->id, 'language_code' => 'ru']);
        });

        return $models;
    }

    protected function createRelatedModels(){
        $this->relatedModels['department_type'] = DepartmentType::factory()->create();
    }


}
