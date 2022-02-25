<?php

namespace App\Traits;

use App\Services\Master\File\FileService;
use Illuminate\Support\Facades\Storage;
use Nette\FileNotFoundException;

trait FileUpload
{

    protected FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function fileUpload($data, $path)
    {
        $file = request('file');
        if (request()->hasFile('file')) {
            $fileName = time() . '.' . $file->extension();
//            $file->move(storage_path($path), $fileName);
            Storage::putFileAs($path, $data['file'], $fileName);
            $data['physical_name'] = $data['file_caption'] ?? $file->getClientOriginalName();
            $data['file_name'] = $fileName;
            unset($data['file']);
            $this->fileService->store($data);

        }

        return $data;
    }

    public function filesUpload($data, $path)
    {
        $files = request()->input('files');

        if ($files) {

            foreach ($files as $key => $item) {
                $fileName = time() . '_' . $key . '.' . $item->extension();
                $item->move(storage_path() . $path, $fileName);
                $data['physical_name'] = $item->getClientOriginalName();
                $data['file_name'] = $fileName;
                $this->fileService->store($data);
            }

        }

        return $data;
    }

    public function fileDelete($id)
    {
        $file = $this->fileService->show($id)->getData();
        if (file_exists(storage_path('app/public/master/file/') . $file->file_name)) {
            unlink(storage_path() . 'app/public/master/file/' . $file->file_name);
        }
        return $this->fileService->delete($id);
    }

    public function fileShow($id)
    {
        $file = $this->fileService->show($id)->getData();
        if ($file) {
            try {
                $path = storage_path('app/public/master/file/') . $file->file_name;
                return response()->file($path);
            } catch (FileNotFoundException $error) {
                return response()->json($error->getMessage(), 404);
            }
        } else {
            return response()->file(public_path() . '/images/no-avatar.png');
        }
    }

}
