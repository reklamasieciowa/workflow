<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Job;
use App\Task;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }

    public function hasRole($id)
    {
        foreach($this->roles as $role) {
            if($role->id === $id){
                return true;
            }
        }
        return false;
    }

    public function isAdmin()
    {
        if($this->hasRole(1)) {
            return true;
        }
        return false;
    }
}
