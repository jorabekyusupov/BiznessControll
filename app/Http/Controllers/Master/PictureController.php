<?php

namespace App\Http\Controllers\Master;


use App\Traits\ImageUpload;
use App\Http\Controllers\Controller;
use App\Services\Master\Picture\PictureService;
use App\Http\Requests\Master\Picture\PictureStoreUpdateRequest;

class PictureController extends Controller
{
    use ImageUpload;

    protected PictureService $pictureService;

    public function __construct(PictureService $pictureService)
    {
        $this->pictureService = $pictureService;
    }

    public function store(PictureStoreUpdateRequest $pictureStoreUpdateRequest)
    {
        return $this->pictureService->pictureStore($pictureStoreUpdateRequest->validated(), $pictureStoreUpdateRequest);
    }

    public function getPicture($id)
    {
        return $this->pictureService->pictureShow($id);
    }
}
