<?php

namespace Tests\Feature\Organization\Basic;

use App\Models\Organization\TaskManagement\Comment\Comment;
use App\Models\Organization\TaskManagement\Task\Task;
use Tests\Feature\OrganizationBase;
use Illuminate\Support\Str;

class CommentTest extends OrganizationBase
{
    public function setUp(): void
    {
        $this->modelClass = Comment::class;
        $this->modelName = 'comment';
        $this->moduleShort = 'tm';

        $this->singleStructure = [
            'id',
            'task_id',
            'text',
            'reply_employee_id',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ];

        $this->indexStructure = [
            '*' =>[ 
                'id',
                'task_id',
                'text',
                'reply_employee_id',
                'created_by',
                'updated_by',
                'created_at',
                'updated_at',
                'file',
                'created_user' => [
                    'id',
                    'user_id',
                    'avatar',
                    'first_name',
                    'last_name',
                    'middle_name',
                ]
            ]
        ];

        $this->rawData = [
            'task_id' => 1,
            'text' => 'Test comment',
            'reply_employee_id' => 1
        ];

        parent::setUp();
    }

    // create

    public function test_can_create()
    {
        $this->createRelatedModels();
        $this->rawData['task_id'] = $this->relatedModels['task']->id;
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
        unset($data2['text']);
        $this->postJson($this->route($this->apiUrl . '.store'), $data, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->postJson($this->route($this->apiUrl . '.store'), $data2, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // update

    public function test_can_update_item()
    {
        $model = $this->createModels()[0];
        $this->rawData['text'] = $model->text . ' upd';
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
    
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_delete()
    {
        $model = $this->createModels()[0];

        $this->deleteJson($this->route($this->apiUrl . '.destroy', [$this->paramName => $model->id + 1], $this->getHeadersWithToken()))
            ->assertStatus(404);
    }


    protected function createModels($count = 1){

        $this->createRelatedModels();
        $data = [
            'task_id' => $this->relatedModels['task']->id,
        ];
        $models = $this->modelClass::factory($count)->create($data);

        return $models;
    }

    protected function createRelatedModels(){
        $this->relatedModels['task'] = Task::factory()->create();
    }


}
