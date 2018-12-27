@extends('front.layouts.front')

@section('nav')
@include('front._partials._nav')
@endsection

@section('content')

<div class="container pt-4">

 <h2>Wszystkie projekty: {{$total}}</h2>

 <div class="row ">
  @forelse($jobs as $job)
  @php
    $progress = round($job->tasks->where("status_id","3")->count() / $job->tasks->count() * 100)
  @endphp

    <!-- Grid column -->
  <div class="col-lg-4 col-md-6 col-sm-12">
<!-- Card -->
<div class="card my-3">
  <!-- Card content -->
  <div class="card-body">
    <div class="job-status">
      @if($job->status->id == 1)
        <i class="fa fa-play-circle  m-2"></i>
      @elseif($job->status->id == 2)
        <i class="fa fa-hourglass-half m-2"></i>
      @else
        <i class="fa fa-check m-2"></i>
      @endif
    </div>
    <!-- Title -->
    <h4 class="card-title">{{$job->name}}</h4>
    
    <!-- Text -->
    <p class="card-text">{{$job->description}}</p>
    <hr>
    <div class="row">
      <p class="col-sm"><i class="fa fa-list-ol text-body"></i> {{$job->tasks->count()}}: </p>
      <p class="col-sm"><i class="fa fa-play-circle text-danger"></i> {{$job->tasks->where("status_id","1")->count()}}</p>
      <p class="col-sm"><i class="fa fa-hourglass-half text-warning"></i> {{$job->tasks->where("status_id","2")->count()}}</p>
      <p class="col-sm"><i class="fa fa-check text-success"></i> {{$job->tasks->where("status_id","3")->count()}}</p>
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
<!--       <li class="list-inline-item" style="width: 100%;"><i class="fa fa-user-circle grey-text m-2"></i>{{$job->user->name}}</li> -->
    </ul>
  </div>
  </div>

  <!-- Card footer -->
    <div class="rounded-bottom text-center pt-3 card-status grey lighten-4">
    <ul class="list-unstyled list-inline font-small">
      <li class="list-inline-item card-text pr-2 deadline">
        <i class="fa fa-user-circle m-2"></i> {{$job->user->name}}
      </li>
      <li class="list-inline-item card-text pr-2 deadline"><i class="fa fa-stop-circle m-2"></i> {{Carbon\Carbon::parse($job->deadline)->diffForHumans(null, false)}}
      </li>
    </ul>
  </div>
</div>
<!-- Card -->

</div>
@empty
  <div class="alert alert-info" role="alert">
    Aktualnie nie ma żadnych projektów.
  </div>
@endforelse

<!-- Grid column -->
</div>
</div>

@endsection

@section('footer')
footer
@endsection