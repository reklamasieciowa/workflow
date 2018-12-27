<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Job;
use App\Status;
use App\User;

class Task extends Model
{
    public function job()
    {
    	return $this->belongsTo(Job::class);
    }

    public function status()
    {
    	return $this->belongsTo(Status::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
