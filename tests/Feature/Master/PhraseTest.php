<?php

namespace Tests\Feature\Master;

use App\Models\Master\Phrase\Phrase;
use App\Models\Master\Phrase\PhraseTranslation;
use Tests\Feature\MasterBase;

class PhraseTest extends MasterBase
{
    protected $getPhrase;

    public function setUp(): void
    {
        $this->modelName = 'phrase';
        $this->modelClass = Phrase::class;
        $this->modelTranslationClass = PhraseTranslation::class;


        parent::setUp();

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
                    'object_id',
                    'language_code',
                    'translation'

                ]
            ]
        ];

        $this->indexStructure = [
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
                    'phrase_translation_id',
                    'language_code',
                    'translation'
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ];
       $this->getPhrase=[
        '*' => [
                'id',
                'word',
                'page_id',
                'created_by',
                'updated_by',
                'deleted_by',
                'deleted_at',
                'created_at',
                'updated_at'
            ]
       ];

        $this->listStructure = $this->indexStructure;

        $this->rawData = [
            'word' => 'yuz',
            'page_id' => 3,
            'translations' => [
                [
                    'language_code' => 'ru',
                    'translation' => 'Test service ru',
                ],
                [
                    'language_code' => 'uz',
                    'translation' => 'Test service uz',
                ],
                [
                    'language_code' => 'uzc',
                    'translation' => 'Test service uzc',
                ]
            ]
        ];
    }


    // create

    // create da agar header token berilsa va form ma'lumotlari jo'natilsa, 201 qaytishi kerak
    // qaytgan response strukturasi belgilangan strukturaga mos kelishi kk
    // qaytgan response tarkibida jo'natilgan ma'lumotlar bo'lishi kerak
    public function test_can_create_item()
    {
        $this->json("post", $this->route($this->apiUrl . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
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
        $rawData = $this->rawData;
        unset($rawData['word']);

        $this->json("post", $this->route($this->apiUrl . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // create da agar Body raw da kerakli strukturada json data jo'natilmasa 501 xato qaytishi kerak
    public function test_return_implementation_error_when_body_structure_is_wrong_on_create()
    {
        $rawData = $this->rawData;
        $translations = $rawData['translations'];
        unset($rawData['word']);
        $rawData['translations1'] = $translations;

        $this->json("post", $this->route($this->apiUrl . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }
     // create da unique fieldarni qayta post qilinsa xato qaytishi kerak
     public function test_return_validation_error_when_send_dublicate_data_on_create()
     {
         $model = $this->createModels()[0];
         $rawData = $this->rawData;
         $rawData['word'] = $model->word;

         $this->json("post", $this->route($this->apiUrl . '.store'), $rawData, $this->getHeadersWithToken())
             ->assertStatus(422);
     }



    // update

    // update da agar header token berilsa va form ma'lumotlari jo'natilsa, 200 qaytishi kerak
    public function test_can_update_item()
    {
        $model = $this->createModels()[0];
        $rawData = $this->prepareDataForUpdate($model);
        // dd($model);

        $this->putJson($this->route($this->apiUrl . '.update', [$this->paramName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // update da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $model = $this->createModels()[0];
        $rawData = $this->prepareDataForUpdate($model);

        $this->putJson($this->route($this->apiUrl . '.update', [$this->paramName => $model->id]), $rawData)
            ->assertStatus(401);
    }

    // update da agar required fieldlar jo'natilmasa 422 xato qaytishi kerak
    public function test_return_validation_error_when_required_fields_not_sent_on_update()
    {
        $model = $this->createModels()[0];
        $rawData =$this->prepareDataForUpdate($model);
        unset($rawData['word']);

        $this->putJson($this->route($this->apiUrl . '.update', [$this->paramName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }
     // updateda agar unique fieldlarni o'zgartirmasdan jo'natilsa xato qaytmasligi kerak
     public function test_can_update_item_with_not_changed_unique_fields_on_update()
     {
         $model = $this->createModels()[0];
         $rawData['word'] =  $model->word;
         $this->putJson($this->route($this->apiUrl . '.update', [$model->id]), $rawData, $this->getHeadersWithToken())
             ->assertStatus(200);
     }


    // index

    // index da agar headerda token berilsa,
    // required param bo'lgan language berilsa,
    // 200 qaytishi kerak
    public function test_can_index_items()
    {
        $this->createModels(3);

        $this->getJson($this->route($this->apiUrl . '.index', ['language' => 'uz', 'search' => '']), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->indexStructure);
    }

    // index da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_index()
    {
        $this->getJson($this->route($this->apiUrl . '.index'))
            ->assertStatus(401);
    }

    // index da agar headerda token berilsa va language berilmasa 422 qaytishi kerak
    public function test_return_validation_error_when_language_param_not_sent_on_index()
    {
        $this->createModels(3);

        $this->getJson($this->route($this->apiUrl . '.index'), $this->getHeadersWithToken())
            ->assertStatus(200);
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

        $this->getJson($this->route($this->apiUrl . '.show', [$this->paramName => $model->id]), $this->getHeadersWithToken())
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
        $this->getJson($this->route($this->apiUrl . '.show', [$this->paramName => $model->id + 1]), $this->getHeadersWithToken())
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

    //global
    //global da agar header token berilmasa 200 qaytishi kerak
    //qaytgan response strukturasi belgilangan strukturaga mos kelishi kerak
    public function test_can_global_item()
    {
        $this->getJson($this->route('global', ['language_code' => 'ru']))
            ->assertStatus(200)
            ->assertJsonStructure($this->indexStructure);
    }

    //global da agar header token berilsa 200 qaytishi kerak
    //qaytgan response strukturasi belgilangan strukturaga mos kelishi kk
    public function test_can_global_token()
    {
        $this->getJson($this->route('global', ['language_code' => 'ru']), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->indexStructure);
    }
    //global ga agar getda language code berilmasa 500 qaytishi kerak
    public function test_can_global_not_language_code()
    {
        $this->getJson($this->route('global'), $this->getHeadersWithToken())
            ->assertStatus(500);
    }
    //phrare
    //Phrase ga headerga token berilsa 200 qaytishi kerak
    //qaytgan response strukturasi belgilangan strukturaga mos kelishi kerak
    public function test_getPhrase_item()
    {
        $this->createModels(1);
        $this->getJson($this->route($this->apiUrl . '.get_phrases'), $this->getHeadersWithToken())
        ->assertStatus(200)
        ->assertJsonStructure($this->getPhrase);
    }

    //phrase ga agar headerga token berilmas 401 status qaytishi kerak
    public function test_getPhrase_not_token()
    {
        $this->getJson($this->route($this->apiUrl . '.get_phrases'))
        ->assertStatus(401);
    }

    //ushbu funksiya update holatiga tayyorlab beradi
    private function prepareDataForUpdate($model)
    {

        $translations = [];
        foreach ($model->translations as $tr) {
            $translations[] = [
                'id' => $tr->id,
                'object_id' => $model->id,
                'language_code' => $tr->language_code,
                'translation' => $tr->translation . ' updated'
            ];
        }

        $rawData = [
            'word' => $model->word,
            'page_id' => $model->page_id,
            'translations' => $translations
        ];

        return $rawData;
    }
}
