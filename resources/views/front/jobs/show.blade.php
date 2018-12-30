@extends('front.layouts.front')

@section('content')

@php
$progress = round(($job->tasks->where("status_id","3")->count()+$job->tasks->where("status_id","4")->count()) / $job->tasks->count() * 100)
@endphp

<div class="container">
	<div class="card">

		<div class="card-body">
			<div class="row">
				<div class="col-md-12 col-lg-6">
					<a href="{{ route('job_status_change', [$job->id]) }}" class="text-dark">
						<h3 class="card-title">{{$job->name}}
							@if($job->status->id == 1)
							<i class="fa fa-play-circle text-danger m-2"></i>
							@elseif($job->status->id == 2)
							<i class="fa fa-hourglass-half text-warning m-2"></i>
							@elseif($job->status->id == 3)
							<i class="fa fa-check text-success m-2"></i>
							@else
							<i class="fa fa-check-circle text-success m-2"></i>
							@endif

						</h3>
					</a>
					<p class="desc">
						{{ $job->description }}
					</p>
				</div>

				<div class="col-md-12 col-lg-6">
					<div class="progress md-progress mt-3" style="height: 20px;">
						<div class="progress-bar progress-bar-striped text-dark
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
						" role="progressbar" style="width: {{$progress}}%; height: 20px;" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">{{$progress}}%</div>
					</div>

					<div class="row">
						<div class="deadline col-6">
							<i class="fa fa-stop-circle fa-lg m-2"></i> {{Carbon\Carbon::parse($job->deadline)->diffForHumans(null, false)}}
						</div>

						<div class="col-6 user">
							<ul>
							@foreach($job->user as $user)
							<li><i class="fa fa-user-circle fa-lg m-2"></i> {{ $user->name }}</li>
							@endforeach
							</ul>
						</div>
					</div>
				</div>

			</div>

			<h4 class="mt-3">Zadania:</h4>
			<ul class="list-group">
				@foreach($job->tasks as $task)
				<li class="list-group-item">
					<a href="{{ route('task_status_change', [$task->id]) }}" class="text-dark">
						<div class="md-v-line"></div>
						@if($task->status_id == 1)
						<i class="fa fa-play-circle fa-lg text-danger mr-3"></i>
						@elseif($task->status_id == 2)
						<i class="fa fa-hourglass-half fa-lg text-warning mr-3"></i>
						@elseif($task->status_id == 3)
						<i class="fa fa-check fa-lg text-success mr-3"></i>
						@else
						<i class="fa fa-check-circle fa-lg mr-3 text-success"></i>
						@endif

						<strong>{{ $task->name }}</strong>
						{{ $task->description }}
					</a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection