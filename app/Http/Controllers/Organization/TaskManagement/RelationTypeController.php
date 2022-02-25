<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\TaskManagement\RelationType\RelationTypeStoreUpdateRequest;
use App\Services\Organization\TaskManagement\RelationType\RelationTypeService;
use Illuminate\Http\Request;

class RelationTypeController extends Controller
{
    protected RelationTypeService $relationTypeService;

    public function __construct(RelationTypeService $relationTypeService)
    {
        $this->relationTypeService = $relationTypeService;
    }

    public function index()
    {
        return $this->relationTypeService->get()->get();
    }


    public function store(RelationTypeStoreUpdateRequest $relationTypeStoreUpdateRequest)
    {
        return $this->relationTypeService->store($relationTypeStoreUpdateRequest->validated());
    }


    public function show($id)
    {
        return $this->relationTypeService->show($id);
    }


    public function update($id, RelationTypeStoreUpdateRequest $relationTypeStoreUpdateRequest)
    {
        return $this->relationTypeService->edit($id, $relationTypeStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->relationTypeService->delete($id);
    }
}
