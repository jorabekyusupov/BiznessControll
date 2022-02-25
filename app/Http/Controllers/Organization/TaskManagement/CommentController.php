<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\TaskManagement\Comment\CommentStoreUpdateRequest;
use App\Services\Organization\TaskManagement\Comment\CommentService;

class CommentController extends Controller
{

    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index()
    {
        return $this->commentService->list(request()->only('task_id'), ['file', 'created_user:id,user_id,avatar,first_name,last_name,middle_name']);
    }

    public function store(CommentStoreUpdateRequest $commentStoreUpdateRequest)
    {
        return $this->commentService->store($commentStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->commentService->show($id);
    }

    public function update($id, CommentStoreUpdateRequest $commentStoreUpdateRequest)
    {
        return $this->commentService->edit($id, $commentStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->commentService->delete($id);
    }
}
