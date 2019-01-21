<?php

namespace App\Http\Controllers;

use App\Job;
use App\Task;
use App\Checklist;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if($status) {
            $total = Job::where('status_id', $status)->count();
        } else {
            $total = Job::all()->count();
        }

        if(!Auth::user()->isAdmin())
        {
            $jobs = Auth::user()->jobs
                ->when($status, function ($query, $status) {
                    return $query->where('status_id', $status);
                });
        } 
        else
        {
            $jobs = Job::orderBy('deadline', 'asc')
                ->when($status, function ($query, $status) {
                        return $query->where('status_id', $status);
                    })
                ->paginate(15);
        }

        return view('front.jobs.index', compact('jobs', 'total'));
    }

    /**
     * Display a listing of deleted resources for current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $total = count(Job::onlyTrashed()->get());

        if(!Auth::user()->isAdmin())
        {
            $jobs = Auth::user()->jobs->onlyTrashed()
                ->where('id', Auth::user()->id)
                ->paginate(15)
                ->get();
        } 
        else
        {
            $jobs = Job::onlyTrashed()
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
        $users = User::all();
        return view('front.jobs.create', compact('users', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'deadline' => 'required|date'
        ]);

        $job = Job::create(
            [
                'name' => $request->name,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'status_id' => '1'
            ]
        );

        if($request['checklist']) {

            $checklistTasks = Checklist::all();

            foreach($checklistTasks as $task) {
                //create tasks
                Task::create([
                    'name' => $task['name'],
                    'description' => $task['description'],
                    'status_id' => '1',
                    'job_id' => $job->id
                ]);
            }
        }

        if($request->tasks) {
            foreach($request->tasks as $task) {
                
                //create tasks
                Task::create([
                    'name' => $task['name'],
                    'description' => $task['description'],
                    'status_id' => '1',
                    'job_id' => $job->id
                ]);
            }
        }

        if($request->users) {

            $users = array_unique($request->users);

            foreach($request->users as $key => $user) {
                
                //Attach job to user
                $user = User::find($key);

                $user->jobs()->attach($job->id);
            }
        }

        $request->session()->flash('status', 'Projekt '.$job->name.' utworzony.');

        return redirect()->route('job', [$job->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::withTrashed()->find($id);
        return view('front.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::withTrashed()->find($id);
        return view('front.jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job = Job::withTrashed()->find($id);

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'deadline' => 'required'
        ]);

        $job->name = $request->name;
        $job->description = $request->description;
        $job->deadline = $request->deadline;

        $job->save();

        foreach ($request->tasks as $task_old) {
            $task = Task::find($task_old["id"]);
            $task->name = $task_old['name'];
            $task->description = $task_old['description'];

            $task->save();
        }

        $request->session()->flash('status', 'Projekt '.$job->name.' zapisany.');

        return redirect()->route('job', [$job->id]);
    }

    /**
     * Change the specified resources status in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function change_status($id)
    {
        $job = Job::withTrashed()->find($id);

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
    public function destroy($id, Request $request)
    {
        $job = Job::withTrashed()->find($id);

        if(!$job->trashed()) {
            //delete job, leave tasks and users assoc
            $job->delete($job->id);

            $request->session()->flash('status', 'Projekt '.$job->name.' przeniesiono do kosza.');

        } else {
            //delete job->tasks FORCE soft delete
            foreach($job->tasks as $task) {
                $task->forceDelete();
            }

            $job->user()->detach();

            $job->forceDelete($job->id);

            $request->session()->flash('status', 'Projekt '.$job->name.' usunięty.');
        }

        

        return redirect()->route('jobs');
    }
}
