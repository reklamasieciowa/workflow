@extends('front.layouts.front')

@section('content')
<div class="container pt-4">

 <div class="row">
     <div class="col-lg-6">
      <h2>Wszystkie projekty: <span id="count-total">{{ $total }}</span> <a href="#" class="text-muted"><i class="fas fa-grip-horizontal mx-2"></i></a> <a href="#" class="text-muted"><i class="fas fa-list"></i></a></h2>
    </div>
        <div class="col-lg-6">
      <div class="md-form mt-3">
        <input type="text" id="search" class="form-control">
        <label for="search">Szukaj</label>
      </div>
    </div>
 </div>
<div class="row">
 <div class="card-columns jobs">
  <!-- Grid column -->
    @forelse($jobs as $job)

    @if($job->tasks->count())
      @php
        $progress = round(($job->tasks->where("status_id","3")->count() + $job->tasks->where("status_id","4")->count()) / $job->tasks->count() * 100)
      @endphp
    @else
      @php
       $progress = 0;
      @endphp
    @endif

    <!-- Card -->
    <div class="searchable">
    <div class="card mt-4 mb-0">
        @if($job->trashed())
          <div class="jobs-trashed">
            <i class="fa fa-trash-alt text-danger fa-lg m-2"></i>
          </div>
        @endif
        <div class="jobs-status">
          <a href="{{ route('job_status_change', [$job->id]) }}">
            @if($job->status_id == 1)
            <i class="far fa-play-circle fa-lg m-2 text-danger"></i>
            @elseif($job->status_id == 2)
            <i class="fa fa-hourglass-half fa-lg m-2 text-warning"></i>
            @elseif($job->status_id == 3)
            <i class="fa fa-check text-success fa-lg m-2 text-success"></i>
            @else
            <i class="fa fa-check-circle fa-lg m-2 text-success"></i>
            @endif
          </a>
        </div>
      <!-- Card content -->
        <div class="card-header pt-3">
           <h4 class="card-title mt-3">{{$job->name}}</h4>
        </div>
  
      <div class="card-body">

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
      <div class="card-footer text-center pt-3 card-status grey lighten-4">
        <ul class="list-unstyled list-inline font-small">
          <li class="list-inline-item card-text pr-2 deadline">
              @if(Carbon\Carbon::parse($job->deadline)->diffInDays(false, false) > 0)
                <span class="font-weight-bold">
                  <i class="fas fa-skull-crossbones text-danger fa-lg m-2"></i>
                  {{Carbon\Carbon::parse($job->deadline)->diffForHumans(null, false, false, 2)}}
                </span>
              @elseif(Carbon\Carbon::parse($job->deadline)->diffInDays(false, false) == 0)
                  <i class="fas fa-exclamation-triangle text-danger fa-lg m-2"></i>
                  {{Carbon\Carbon::parse($job->deadline)->diffForHumans(null, false, false, 2)}}
              @elseif(Carbon\Carbon::parse($job->deadline)->diffInDays(false, false) == -1)
                  <i class="fas fa-stopwatch light-blue-text fa-lg m-2"></i>
                  {{Carbon\Carbon::parse($job->deadline)->diffForHumans(null, false, false, 2)}}
              @else
                <i class="far fa-calendar-check m-2 fa-lg"></i>
                {{Carbon\Carbon::parse($job->deadline)->diffForHumans(null, false, false, 2)}}
              @endif
          </li>
        </ul>
      </div>
    </div>


    <div class="actions mt-0 text-center">
      <div class="btn-group" role="group" aria-label="edycja">
          <a href="{{ route('job', [$job->id]) }}" type="button" class="btn btn-default btn-sm"><i class="fa fa-eye text-white fa-lg"></i></a>
          <a href="{{ route('job_edit', [$job->id]) }}" type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt text-white fa-lg"></i></i></a>
          <a href="{{ route('job_destroy', [$job->id]) }}" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-alt text-white fa-lg"></i></a>
      </div>
    </div>
</div>
    <!-- Card -->


    @empty
    <div class="card text-center text-white bg-info">
      <div class="card-header">:(</div>
      <div class="card-body">
        <h5 class="card-title">Aktualnie nie ma takich projektów.</h5>
        <a href="{{ route('jobs') }}" class="btn btn-indigo mt-3" role="button">Zobacz wszystkie projekty</a>
      </div>
    </div>

      @endforelse

      <!-- Grid column -->
    </div>
</div>


<div class="container mt-5">
  <div class="row">
    <div class="col-lg-12">
      {{ $jobs->links() }}
    </div>
  </div>
</div>

@endsection