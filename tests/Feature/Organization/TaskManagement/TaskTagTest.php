<?php

namespace Tests\Feature\Organization\Basic;

use App\Models\Organization\HumanResources\Department\Department;
use App\Models\Organization\TaskManagement\Tag\Tag;
use App\Models\Organization\TaskManagement\Task\Task;
use App\Models\Organization\TaskManagement\TaskTag\TaskTag;
use Tests\Feature\OrganizationBase;
use Illuminate\Support\Str;

class TaskTagTest extends OrganizationBase
{
    public function setUp(): void
    {
        $this->modelClass = TaskTag::class;
        $this->modelName = 'task-tag';
        $this->moduleShort = 'tm';

        $this->singleStructure = [
            'id',
            'tag_id',
            'task_id',
        ];

        $this->rawData = [
            'task_id' => 1,
            'tag_id' => 1,
        ];

        parent::setUp();
    }

    // create

    public function test_can_create()
    {
        $this->createRelatedModels();
        $this->rawData['task_id'] = $this->relatedModels['task']->id;
        $this->rawData['tag_id'] = $this->relatedModels['tag']->id;
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(201);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_create()
    {
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData)->assertStatus(401);
    }

    public function test_return_validation_error_when_required_fields_not_send_on_create()
    {
        $data = $data2 = $this->rawData;
        unset($data['task_id']);
        unset($data2['tag_id']);
        $this->postJson($this->route($this->apiUrl . '.store'), $data, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->postJson($this->route($this->apiUrl . '.store'), $data2, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    public function test_return_dublicate_error_when_wrong_data_send_on_create()
    {
        $model = $this->createModels()[0];
        $this->rawData['task_id'] = $model->task_id;
        $this->rawData['tag_id'] = $model->tag_id;
        $this->postJson($this->route($this->apiUrl . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // update

    public function test_can_update_item()
    {
        $model = $this->createModels()[0];
        $this->createRelatedModels();
        $this->rawData['tag_id'] = $this->relatedModels['tag']->id;
        $this->putJson($this->route($this->apiUrl . '.update', [$this->paramName => $model->id]), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $model = $this->createModels()[0];
        $this->putJson($this->route($this->apiUrl . '.update', [$this->paramName => $model->id]), [])
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
            ->assertStatus(200);
    }

    // delete da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_delete()
    {
        $model = $this->createModels()[0];

        $this->deleteJson($this->route($this->apiUrl . '.destroy', [$this->paramName => $model->id]))
            ->assertStatus(401);
    }


    protected function createModels($count = 1){

        $this->createRelatedModels();
        $data = [
            'task_id' => $this->relatedModels['task']->id,
            'tag_id' => $this->relatedModels['tag']->id,
        ];
        $models = $this->modelClass::factory($count)->create($data);

        return $models;
    }

    protected function createRelatedModels(){
        $this->relatedModels['task'] = Task::factory()->create();
        $this->relatedModels['tag'] = Tag::factory()->create();
    }


}
