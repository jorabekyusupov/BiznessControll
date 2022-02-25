<?php

namespace Tests\Feature\Master;

use App\Models\Master\File;
use Illuminate\Http\UploadedFile;
use Tests\Feature\MasterBase;

class FileTest extends MasterBase
{
    public function setUp(): void
    {
        $this->hasTranslation = false;
        $this->modelName = 'file';
        $this->modelClass = File::class;

        $this->rawData = [
            'object_type' => 'ong',
            'object_id' => 1,
            'file' => UploadedFile::fake()->image('test.pdf')->size(100)
        ];

        parent::setUp();
    }


    // create

    public function test_can_create_item()
    {
        $this->json("post", $this->route($this->apiUrl . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // create da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_create()
    {
        $this->json("post", $this->route($this->apiUrl . '.store'), $this->rawData)->assertStatus(401);
    }

    // create da agar required fieldlar jo'natilmasa 422 xato qaytishi kerak
    public function test_return_validation_error_when_required_fields_not_sent_on_create()
    {
        $rawData =   $rawData2 =  $this->rawData;
        unset($rawData['object_type']);
        unset($rawData2['object_id']);

        $this->json("post", $this->route($this->apiUrl . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->json("post", $this->route($this->apiUrl . '.store'), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // show

    public function test_can_show_item()
    {
        $this->json("post", $this->route($this->apiUrl . '.store'), $this->rawData, $this->getHeadersWithToken());

        $file = File::firstWhere(['object_type' => $this->rawData['object_type'], 'object_id' => $this->rawData['object_id']]);

        $params = [
            $this->modelName => $file->id,
        ];

        $this->getJson($this->route($this->apiUrl . '.show', $params), $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // show da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_show()
    {
        $model = $this->createModels()[0];

        $this->getJson($this->route($this->apiUrl . '.show', [$this->modelName => $model->id]))
            ->assertStatus(401);
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
}
