<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jobs = Job::orderBy('deadline', 'ASC')->get();
        $total = Job::count();

        return view('front.home', compact('jobs', 'total'));
    }
}
