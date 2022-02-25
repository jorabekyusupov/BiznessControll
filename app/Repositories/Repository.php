<?php

namespace App\Repositories;

use App\Models\Master\Language;
use App\Models\Master\OrganizationLanguage;
use Illuminate\Support\Facades\Schema;

class Repository
{
    public object $model, $modelView, $modelTranslation;

    public function query($relations = null)
    {
        if ($relations) {
            return $this->model->with(...$relations);
        }
        return $this->model->query();
    }

    public function queryView($relations = null)
    {
        if ($relations) {
            return $this->modelView->with(...$relations);
        }
        return $this->modelView->query();
    }

    public function showView($id, $relations = null)
    {
        $model = $this->queryView($relations);
        $model = $model->find($id);
        if ($model) {
            return response()->json($model);
        } else {
            return response('Not found', 404);
        }
    }

    public function create($data)
    {
        $isColExist = Schema::connection($this->model->connection)->hasColumn($this->model->getTable(), 'created_by');
        if ($isColExist)
            $data['created_by'] = auth()->id() ?? 1;

        $model = $this->model->create($data);
        if ($model) {
            return response()->json($model, 201);
        } else {
            return response()->json('Not implemented', 501);
        }
    }

    public function update($id, $data)
    {
        $model = $this->query()->find($id);
        if ($model) {
            $data['updated_by'] = auth()->id();
            $model = $model->update($data);
            if ($model) {
                $model = $this->show($id, null);
                return $model;
            } else {
                return response()->json('Not implemented', 501);
            }
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function show($id, $relations = null)
    {
        $model = $this->query($relations);
        $model = $model->find($id);
        if ($model) {
            return response()->json($model);
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function showTranslation($id, $type, $relation = null )
    {
        $model = $this->show($id, $relation)->getData();
        if ($model != 'Not found') {
            $model_translations = [];

            foreach ($model->translations as $key => $translation) {
                $model_translations[$key] = $translation->language_code;
            }

            if($type == 'm'){
                $not_languages = Language::whereNotIn('code', $model_translations)->get();
            }
            if ($type == 'o'){
                $not_languages = OrganizationLanguage::with('languages')
                    ->whereHas('languages',
                        function ($query) use ($model_translations) {
                            $query->whereNotIn('code', $model_translations);
                        })
                    ->get()->pluck('languages');
            }

            foreach ($not_languages as $not_language) {
                $data['object_id'] = $id;
                if ($type == 'o'){
                    $data['language_code'] = $not_language[0]->code;
                }
                else{
                    $data['language_code'] = $not_language->code;

                }

                $this->modelTranslation::create($data);
            }
            return $this->show($id, $relation)->getData();

        } else {
            return response()->json('Not found', 404);
        }

    }
    public function destroy($id)
    {
        $model = $this->query();
        try {
            $model = $model->find($id);
            $model->delete();
            return response()->json('Successfully deleted', 204);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function softDelete($id)
    {
        $model = $this->query()->find($id);
        if ($model) {
            $model->deleted_by = auth()->id();
            $model->save();
            $model->delete();
            return response()->noContent();
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function createTranslation($object_id, $translations)
    {
        foreach ($translations as $key => $translation) {
            $translation['object_id'] = $object_id;
            $this->modelTranslation->create($translation);
        }
    }

    public function updateTranslation($object_id, $translations)
    {
        foreach ($translations as $translation) {
            $model = $this->modelTranslation->where('object_id', $object_id);
            if ($model && isset($translation['id'])) {
                $model->where('id', $translation['id'])
                    ->update($translation);
            } else {
                $translation['object_id'] = $object_id;
                $this->modelTranslation->create($translation);
            }
        }
    }
}
