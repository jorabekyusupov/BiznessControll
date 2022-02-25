<?php

namespace App\Providers;

use App\Models\Master\File;
use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\TaskManagement\Comment\Comment;
use App\Models\Organization\TaskManagement\RelatedEmployee\RelatedEmployee;
use App\Models\Organization\TaskManagement\Task\Task;
use App\Models\User;
use App\Observers\Master\FileObserver;
use App\Observers\Organization\Basic\EmployeeObserver;
use App\Observers\Organization\TaskManagement\Comment\CommentObserver;
use App\Observers\Organization\TaskManagement\RelatedEmployee\RelatedEmployeeObserver;
use App\Observers\Organization\TaskManagement\Task\TaskObserver;
use App\Observers\Master\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Employee::observe(EmployeeObserver::class);
        User::observe(UserObserver::class);
        Task::observe(TaskObserver::class);
//        Comment::observe(CommentObserver::class);
        RelatedEmployee::observe(RelatedEmployeeObserver::class);
        File::observe(FileObserver::class);
    }
}
