<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Master\Nationality\NationalityStoreUpdateRequest;
use App\Services\Master\Nationality\NationalityService;

class NationalityController extends Controller
{
    protected $nationalityService;

    public function __construct(NationalityService $nationalityService)
    {
        $this->nationalityService = $nationalityService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->nationalityService->getPaginate($indexRequest->validated());
    }

    public function store(NationalityStoreUpdateRequest $nationalityStoreUpdateRequest)
    {
        return $this->nationalityService->store($nationalityStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->nationalityService->show($id);
    }

    public function update($id, NationalityStoreUpdateRequest $nationalityStoreUpdateRequest)
    {
        return $this->nationalityService->edit($id, $nationalityStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->nationalityService->softDelete($id);
    }
}
