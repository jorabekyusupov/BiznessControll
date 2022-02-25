<?php

namespace App\Models\Organization\TaskManagement\Comment;

use App\Models\Master\File;
use App\Models\Organization\Basic\Employee\ViewEmployee;
use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\CommentFactory;

class Comment extends Organization
{
    use NewFactoryTrait;
    protected $table = 'tm_comments';

    protected static string $model_factory = CommentFactory::class;

    protected $fillable = [
        'task_id',
        'text',
        'reply_employee_id',
        'created_by',
        'updated_by'
    ];

    public function file()
    {
        return $this->hasMany(File::class, 'object_id', 'id')
            ->where('object_type', 'task_comment_file');
    }

    public function created_user()
    {
        return $this->hasOne(ViewEmployee::class, 'user_id', 'created_by');
    }

}
