<?php

namespace App;

use App\Status;
use App\Task;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deadline', 'deleted_at',
    ];

    protected $fillable = [
        'name', 'description', 'deadline', 'status_id',
    ];

    public function user()
    {
    	return $this->belongsToMany(User::class);
    }

    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }

    public function status()
    {
    	return $this->belongsTo(Status::class);
    }
}
