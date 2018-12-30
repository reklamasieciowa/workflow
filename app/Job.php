<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Task;
use App\Status;

class Job extends Model
{
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
