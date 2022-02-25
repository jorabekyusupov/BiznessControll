<?php

namespace Tests\Feature\Master;

use App\Models\Master\Picture;
use Illuminate\Http\UploadedFile;
use Tests\Feature\Base;
use Tests\Feature\MasterBase;

class PictureTest extends MasterBase
{
    public function setUp(): void
    {
        $this->hasTranslation = false;
        $this->modelName = 'picture';
        $this->modelClass = Picture::class;

        $this->singleStructure = [
            "id",
            "object_type",
            'is_default',
            "object_id",
            "physical_name",
            "picture_name",
            "created_by",
            "updated_at",
            "created_at"
        ];


        $this->rawData = [
            "object_type" => 'ong',
            'is_default' => 0,
            "object_id" => 1,
            "picture" => UploadedFile::fake()->image('avatar.jpg')->size(100)
        ];

        parent::setUp();
    }

    // create

    public function test_can_create_item()
    {
        $this->rawData['physical_name'] = $this->rawData['picture']->name;
        $this->rawData['picture_name'] = time() . '.' . $this->rawData['picture']->extension();
        unset($this->rawData['picture']);

        $get = $this->rawData;
        unset($get['physical_name'],$get['picture_name']);
        
        $this->withExceptionHandling();
        
        $this->json("post", $this->route($this->apiUrl . '.store', $get), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(201);
    }

    // create da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_create()
    {
        $this->json("post", $this->route($this->apiUrl . '.store'), $this->rawData)->assertStatus(401);
    }
    // create da agar required fieldlar jo'natilmasa 422 xato qaytishi kerak
    public function test_return_validation_error_when_required_fields_not_sent_on_create()
    {
        $rawData = $rawData2 = $this->rawData;
        unset($rawData['object_type']);
        unset($rawData2['object_id']);

        $this->json("post", $this->route($this->apiUrl . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->json("post", $this->route($this->apiUrl . '.store'), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    //Get Picture

    //get picture ga header token berilsa 200 qaytishi kerak
    public function test_getPicture_item()
    {
        $model = $this->createModels()[0];

        $this->getJson($this->route( $this->modelName .'.get-'.$this->modelName, [$model->id]), $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    //get picture ga header token berilmas 200 qaytishi kerak
    public function test_getPicture_not_token()
    {
        $model = $this->createModels()[0];

        $this->getJson($this->route( $this->modelName .'.get-'.$this->modelName, [$model->id]))
            ->assertStatus(200);
    }

    //get picture ga mavjud bo'lmagan id berganda 200
    public function test_getPicture_not_id()
    {
        $model = $this->createModels()[0];

        $this->getJson($this->route( $this->modelName .'.get-'.$this->modelName, [$model->id+1]), $this->getHeadersWithToken())
            ->assertStatus(200);
    }

}
