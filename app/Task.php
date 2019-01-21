<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Job;
use App\Status;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;


class Task extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'status_id', 'job_id',
    ];

	protected $dates = ['deleted_at'];

    public function job()
    {
    	return $this->belongsTo(Job::class);
    }

    public function status()
    {
    	return $this->belongsTo(Status::class);
    }
}
