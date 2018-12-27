<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;
use App\Job;

class Status extends Model
{
    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }

    public function jobs()
    {
    	return $this->hasMany(Job::class);
    }
}
