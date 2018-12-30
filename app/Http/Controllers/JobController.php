<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class JobController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource for current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        $total = count(Job::all());

        if(!Auth::user()->isAdmin())
        {
            $jobs = Auth::user()->jobs
                ->when($status, function ($query, $status) {
                    return $query->where('status_id', $status);
                });
        } 
        else
        {
            $jobs = Job::orderBy('deadline', 'ASC')
                ->when($status, function ($query, $status) {
                        return $query->where('status_id', $status);
                    })
                ->paginate(15);
        }

        

        return view('front.jobs.index', compact('jobs', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return view('front.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function change_status(Job $job)
    {
        $max_id = DB::table('statuses')->max('id');

        if($job->status_id < $max_id)
        {
            $job->status_id += 1;
            $job->save();
        }
        else 
        {
            $job->status_id = 1;
            $job->save();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
