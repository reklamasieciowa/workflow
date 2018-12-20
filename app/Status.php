<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;

class Status extends Model
{
    public function tasks()
    {
    	return $this->belongsToMany(Task::class);
    }
}
