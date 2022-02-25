<?php

namespace App\Models;

use App\Models\Master\Language;
use App\Models\Master\Organization;
use App\Models\Master\Picture;
use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\Basic\Employee\ViewEmployee;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $connection = 'pgsql';

    protected $fillable = [
        'username',
        'name',
        'phone',
        'default_database',
        'email_verified_at',
        'password',
        'verification_token',
        'language_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function findAndValidateForPassport($username, $password)
    {
        $user = $this->where('username', $username)->first();
        if (!Hash::check($password, $user->password)) {
            return false;
        }
        return $user;
    }

    public function organization()
    {
        return $this->hasOne(Organization::class, 'db_name', 'default_database');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id', 'id');
    }

    public function view_employee()
    {
        return $this->hasOne(ViewEmployee::class, 'user_id', 'id');
    }

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
