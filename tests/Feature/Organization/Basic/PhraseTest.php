<?php

namespace Tests\Feature\Organization\Basic;

use App\Models\Organization\Basic\Phrase\Phrase;
use App\Models\Organization\Basic\Phrase\PhraseTranslation;
use Tests\Feature\OrganizationBase;
use Illuminate\Support\Str;

class PhraseTest extends OrganizationBase
{
    public function setUp(): void
    {
        $this->hasTranslation = true;
        $this->modelClass = Phrase::class;
        $this->modelTranslationClass = PhraseTranslation::class;
        $this->modelName = 'phrase';
        $this->moduleShort = '';

        $this->singleStructure = [
            'id',
            'word',
            'page_id',
            'created_by',
            'updated_by',
            'deleted_by',
            'deleted_at',
            'created_at',
            'updated_at',
            'translations' => [
                '*' => [
                    'id',
                    'object_id',
                    'language_code',
                    'translation',
                ],
            ]
        ];

        $this->indexStructure = [
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'word',
                    'created_by',
                    'updated_by',
                    'deleted_by',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                    'phrase_translation_id',
                    'language_code',
                    'translation',
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
            'total'
        ];

        $this->listStructure = [
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'word',
                    'page_id',
                    'created_by',
                    'updated_by',
                    'deleted_by',
                    'deleted_at',
                    'created_at',
                    'updated_at',
                    'translations' => [
                        '*' => [
                            'id',
                            'object_id',
                            'language_code',
                            'translation',
                        ]
                    ]
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
            'total'
        ];

        $this->rawData = [
            'word' => 'test-word',
            'page_id' => 23,
            'translations' =>  [
                [
                    'language_code' =>  'ru',
                    'translation' =>  'Test word ru'
                ],
                [
                    'language_code' =>  'uz',
                    'translation' =>  'Test word uz'
                ]
            ]
        ];

        $this->translateData = [
            'translate_languages' => json_encode(['uz', 'ru']),
            'language_code' => 'ru',
            'page_id' => 1
        ];

        $this->translateStructure = [
            '*' => [
                'id',
                'word',
                'page_id',
                'created_by',
                'updated_by',
                'deleted_by',
                'created_at',
                'updated_at',
                'deleted_at',
                'phrase_translation_id',
                'language_code',
                'translation',
                'translate' => [
                    'id',
                    'word',
                    'page_id',
                    'created_by',
                    'updated_by',
                    'deleted_by',
                    'deleted_at',
                    'created_at',
                    'updated_at',
                    'translations' => [
                        '*' => [
                            'id',
                            'object_id',
                            'language_code',
                            'translation',
                        ]
                    ]
                ]
            ]
        ];

        parent::setUp();
    }

    // create

    public function test_can_create()
    {
        $this->rawData['word'] = Str::random(10);
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_create()
    {
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData)->assertStatus(401);
    }

    public function test_return_validation_error_when_required_fields_not_send_on_create()
    {
        $data = $this->rawData;
        unset($data['word']);
        $this->postJson($this->route($this->apiUrl . '.store'), $data, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    public function test_return_dublicate_error_when_dublicate_data_send_on_create()
    {
        $model = $this->createModels()[0];
        $this->rawData['word'] = $model->word;
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // update

    public function test_can_update_item()
    {
        $model = $this->createModels()[0];
        $this->rawData['word'] = Str::random(10);
        $this->putJson($this->route($this->apiUrl . '.update', [$this->paramName => $model->id]), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $model = $this->createModels()[0];
        $this->putJson($this->route($this->apiUrl . '.update', [$this->paramName => $model->id]), [])
            ->assertStatus(401);
    }

    public function test_return_validation_error_when_required_fields_not_send_on_update()
    {
        $model = $this->createModels()[0];
        $data = $this->rawData;
        unset($data['word']);
        $this->putJson($this->route($this->apiUrl . '.update', [$this->paramName => $model->id]), $data, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    public function test_return_dublicate_error_when_dublicate_data_send_on_update()
    {
        $model1 = $this->createModels()[0];
        $model2 = $this->createModels()[0];
        $this->rawData['word'] = $model1->word;
        $this->putJson($this->route($this->apiUrl . '.update', [$this->paramName => $model2->id]), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }


    // index

    public function test_can_index_items()
    {
        $this->createModels(1);
        $this->getJson($this->route($this->apiUrl . '.index', ['search' => '']), $this->getHeadersWithToken())
            ->assertJsonStructure($this->indexStructure)
            ->assertStatus(200);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_index()
    {
        $this->createModels(1);
        $this->getJson($this->route($this->apiUrl . '.index', ['search' => '']))
            ->assertStatus(401);
    }

    // list

    public function test_can_list_items()
    {
        $this->createModels(1);
        $this->getJson($this->route('organization.phrase-list', ['search' => '']), $this->getHeadersWithToken())
            ->assertJsonStructure($this->listStructure)
            ->assertStatus(200);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_list()
    {
        $this->createModels(1);
        $this->getJson($this->route('organization.phrase-list', ['search' => '']))
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

    // delete da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_delete()
    {
        $model = $this->createModels()[0];
        $this->deleteJson($this->route($this->apiUrl . '.destroy', [$this->paramName => $model->id + 1]), $this->getHeadersWithToken())
            ->assertStatus(404);
    }

    // translate

    public function test_can_translate()
    {
        $this->createModels();
        $this->getJson($this->route('organization.translate', $this->translateData), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->translateStructure);
    }


    public function test_return_validation_error_when_required_fields_not_send_on_translate()
    {
        $this->createModels();
        $data = $data2 = $this->translateData;
        unset($data['translate_languages']);
        unset($data2['language_code']);
        $this->getJson($this->route('organization.translate', $data), $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->getJson($this->route('organization.translate', $data2), $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // show da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_translate()
    {
        $this->createModels();
        $this->getJson($this->route('organization.translate', $this->translateData))->assertStatus(401);
    }

    // ****

    protected function createModels($count = 1){

        $models = $this->modelClass::factory($count)->create(['word' =>  Str::random(10)]);

        $models->each(function ($model) {
            $this->modelTranslationClass::factory()->create(['object_id' => $model->id, 'language_code' => 'uz']);
            $this->modelTranslationClass::factory()->create(['object_id' => $model->id, 'language_code' => 'en']);
            $this->modelTranslationClass::factory()->create(['object_id' => $model->id, 'language_code' => 'ru']);
        });

        return $models;
    }


}
