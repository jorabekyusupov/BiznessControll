<?php

namespace App\Models\Organization\TaskManagement\Folder;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\TaskManagement\FolderFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Organization
{
    use SoftDeletes, NewFactoryTrait;

    protected static string $model_factory = FolderFactory::class;

    protected $table = 'tm_folders';

    protected $fillable = [
        'parent_id',
        'name',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id', 'id')->with('children');
    }

}
