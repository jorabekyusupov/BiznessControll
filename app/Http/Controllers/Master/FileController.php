<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\File\FileStoreRequest;
use App\Traits\FileUpload;

class FileController extends Controller
{
    use FileUpload;

    public function store(FileStoreRequest $fileStoreRequest)
    {
        return $this->fileUpload($fileStoreRequest->validated(),'/public/master/file/');
    }

    public function show($id)
    {
        return $this->fileShow($id);
    }

    public function destroy($id)
    {
        return $this->fileDelete($id);
    }
}
