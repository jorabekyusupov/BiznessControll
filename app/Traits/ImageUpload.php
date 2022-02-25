<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageUpload
{
    public function userImageUpload($data, $path, $object = null) // Taking input image as parameter
    {
        $result = array();
        if ($data->hasFile('picture')) {
            if ($object) {
                if ($object->picture_name) {
                    if (file_exists(storage_path($path . $object->picture_name))) {
                        unlink(storage_path($path . $object->picture_name));
                    }
                }
            }
            $imageName = time() . '.' . $data['picture']->extension();
            $result['physical_name'] = $data['picture']->getClientOriginalName();
            Storage::putFileAs($path, $data['picture'], $imageName);
            $result['picture_name'] = $imageName;
        }

        return $result;
    }

}
