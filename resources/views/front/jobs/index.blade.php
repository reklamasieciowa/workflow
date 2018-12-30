@extends('front.layouts.front')

@section('content')
<div class="container pt-4">

 <h2>Wszystkie projekty: {{$total}}</h2>

 <div class="row ">


  <!-- Grid column -->
  <div class="card-columns">
    @forelse($jobs as $job)

    @if($job->tasks->count())
      @php
        $progress = round($job->tasks->where("status_id","4")->count() / $job->tasks->count() * 100)
      @endphp
    @else
       $progress = 0;
    @endif

    <!-- Card -->
    <div class="card my-3">
      <!-- Card content -->
      <div class="card-body">
        <div class="job-status">
          <a href="{{ route('job_status_change', [$job->id]) }}">
            @if($job->status_id == 1)
            <i class="fa fa-play-circle fa-lg m-2 text-danger"></i>
            @elseif($job->status_id == 2)
            <i class="fa fa-hourglass-half fa-lg m-2 text-warning"></i>
            @elseif($job->status_id == 3)
            <i class="fa fa-check text-success fa-lg m-2 text-success"></i>
            @else
            <i class="fa fa-check-circle fa-lg m-2 text-success"></i>
            @endif
          </a>
        </div>
        <!-- Title -->
        <h4 class="card-title">{{$job->name}}</h4>

        <!-- Text -->
        <p class="card-text">{{$job->description}}</p>
        <hr>
        <div class="row">
          <p class="col-sm"><i class="fa fa-list-ol text-body"></i> {{$job->tasks->count()}}</p>
          <p class="col-sm"><i class="fa fa-play-circle text-danger"></i> {{$job->tasks->where("status_id","1")->count()}}</p>
          <p class="col-sm"><i class="fa fa-hourglass-half text-warning"></i> {{$job->tasks->where("status_id","2")->count()}}</p>
          <p class="col-sm"><i class="fa fa-check text-success"></i> {{$job->tasks->where("status_id","3")->count()}}</p>
          <p class="col-sm"><i class="fa fa-check-circle text-success"></i> {{$job->tasks->where("status_id","4")->count()}}</p>
        </div>

        <div class="text-center pt-2 card-progress">
          <ul class="list-unstyled list-inline font-small">
            <li class="list-inline-item">
              <div class="progress md-progress">
                <div class="progress-bar progress-bar-striped
                @if($progress == 0)
                grey lighten-3 w-100
                @elseif($progress > 0 && $progress < 31)
                amber lighten-2
                @elseif($progress > 30 && $progress < 61)
                amber darken-1
                @elseif($progress > 60 && $progress < 100)
                amber darken-4
                @else
                bg-success
                @endif
                " role="progressbar" style="width: {{$progress}}%;" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">{{$progress}}%</div>
              </div>
            </li>
          </ul>
        </div>
      </div>

      <!-- Card footer -->
      <div class="rounded-bottom text-center pt-3 card-status grey lighten-4">
        <ul class="list-unstyled list-inline font-small">
          <li class="list-inline-item card-text pr-2 deadline">
            @foreach($job->user as $user)
            <i class="fa fa-user-circle m-2"></i> {{$user->name}}
            @endforeach
          </li>
          <li class="list-inline-item card-text pr-2 deadline"><i class="fa fa-stop-circle m-2"></i> {{Carbon\Carbon::parse($job->deadline)->diffForHumans(null, false)}}
          </li>
        </ul>
        
        <div class="btn-group my-2" role="group" aria-label="Basic example">
          <a href="{{ route('job', [$job->id]) }}"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button></a>
          <a href="#"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button></a>
          <a href="#"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
        </div>

      </div>
    </div>

    <!-- Card -->


    @empty
    <div class="card text-center text-white bg-info mt-4">
      <div class="card-header">:(</div>
      <div class="card-body">
        <h5 class="card-title">Aktualnie nie ma takich projektów.</h5>
        <a class="btn btn-indigo mt-3" role="button">Zobacz wszystkie projekty</a>
      </div>
      @endforelse

      <!-- Grid column -->
    </div>
  </div>

</div>


@endsection