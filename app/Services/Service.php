<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class Service
{
    protected $repository;
    protected $responce;
    protected $code;

    public function __construct()
    {
        $this->setResponce(null,null);
    }

    public function get($relation = null)
    {
        return $this->repository->query($relation);
    }

    public function getView($relation = null)
    {
        return $this->repository->queryView($relation);
    }

    public function paginate($model, $data)
    {
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 10000;
        $filter = $data['filter'] ?? null;
        $sort = $data['sort'] ?? null;

        return $model->paginate($rows, ['*'], 'page name', $page);

    }
    public function getPaginate($data, $relations = null)
    {
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 10000;
        $filter = $data['filter'] ?? null;
        $sort = $data['sort'] ?? null;

        return $this->repository->query($relations)
            ->paginate($rows, ['*'], 'page name', $page);
    }

    public function index($data, $relations = null)
    {
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 10000;
        $filter = $data['filter'] ?? null;
        $sort = $data['sort'] ?? null;

        $model = $this->repository->query($relations)
            ->where('language_code', auth()->user()->language_code);

        if (isset($sort)) {
            $sort = json_decode($data['sort'], true);
            $model->orderBy($sort['sortField'], $sort['sortOrder'] ?? "ASC");
        } else {
            $model->orderBy('id', "ASC");
        }

        return $model->paginate($rows, ['*'], 'page name', $page);
    }

    public function indexView($data, $relation = null)
    {
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 100000;
        $filter = $data['filter'] ?? null;
        $sort = $data['sort'] ?? null;
        $language_code = $data['language_code'] ?? auth()->user()->language_code;

        $model = $this->repository->queryView($relation)
            ->where('language_code', $language_code);


        if (isset($sort)) {
            $sort = json_decode($data['sort'], true);
            $model->orderBy($sort['sortField'], $sort['sortOrder'] ?? "ASC");
        } else {
            $model->orderBy('id', "ASC");
        }

        return $model->paginate($rows, ['*'], 'page name', $page);
    }

    public function store($data, $translations = null)
    {
        if (!$translations) {
            return $this->repository->create($data);
        } else {
            DB::beginTransaction();
            try {
                $model = $this->repository->create($data);
                $model = $model->getData();
                $this->storeTranslation($model->id, $translations['translations']);
                DB::commit();
                return $model;
            }
            catch (\Throwable $throwable)
            {
                DB::rollBack();
                return  $throwable->getMessage();
            }


        }
    }

    public function edit($id, $data, $translations = null)
    {
        if (!$translations) {
            return $this->repository->update($id, $data);
        } else {
            DB::beginTransaction();
            try {
                $model = $this->repository->update($id, $data);
                $model = $model->getData();
                $this->editTranslation($model->id, $translations['translations']);
                DB::commit();
                return $model;
            }
            catch (\Throwable $throwable){
                DB::rollBack();
                return  $throwable->getMessage();
            }

        }
    }

    public function show($id, $relation = [])
    {
        return $this->repository->show($id, $relation);
    }

    public function showView($id, $relation = [])
    {
        return $this->repository->showView($id, $relation);
    }

    public function showTranslation($id, $type, $relation = null,)
    {
        return $this->repository->showTranslation($id, $type, $relation);
    }

    public function delete($id)
    {
        return $this->repository->destroy($id);
    }

    public function softDelete($id)
    {
        return $this->repository->softDelete($id);
    }

    public function storeTranslation($object_id, $translations)
    {
        return $this->repository->createTranslation($object_id, $translations);
    }

    public function editTranslation($object_id, $translations)
    {
        return $this->repository->updateTranslation($object_id, $translations);
    }

    protected function setResponce($status, $message, $data = null, $code = 200){
        $this->responce = [
            'status' => $status ?? 1,
            'message' => $message ?? 'Success',
            'data' => $data,
        ];
        $this->code = $code;
    }

    protected function return()
    {
        return [
            'responce' => $this->responce,
            'code' => $this->code,
        ];
    }
}
