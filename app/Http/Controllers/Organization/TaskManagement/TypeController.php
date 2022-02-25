<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\TaskManagement\Type\TypeStoreUpdateRequest;
use App\Services\Organization\TaskManagement\Type\TypeService;

class TypeController extends Controller
{

    protected TypeService $typeService;

    public function __construct(TypeService $typeService)
    {
        $this->typeService = $typeService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->typeService->getPaginate($indexRequest->validated());
    }


    public function store(TypeStoreUpdateRequest $typeStoreUpdateRequest)
    {
        return $this->typeService->store($typeStoreUpdateRequest->validated());
    }


    public function show($id)
    {
        return $this->typeService->show($id);
    }


    public function update($id,  TypeStoreUpdateRequest $typeStoreUpdateRequest)
    {
        return $this->typeService->edit($id, $typeStoreUpdateRequest->validated());
    }


    public function destroy($id)
    {
        return $this->typeService->delete($id);
    }
}
