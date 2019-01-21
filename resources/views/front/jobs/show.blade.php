@extends('front.layouts.front')

@section('content')

    @if($job->tasks->count())
      @php
        $progress = round(($job->tasks->where("status_id","3")->count() + $job->tasks->where("status_id","4")->count()) / $job->tasks->count() * 100)
      @endphp
    @else
      @php
       $progress = 0;
      @endphp
    @endif

<div class="container">
	<div class="card job">
		<div class="card-header">
			<div class="row">
				<div class="col-md-12 col-lg-8">
					<h3 class="card-title"><i class="fas fa-tag mr-2 text-muted"></i> {{$job->name}}
					<a href="{{ route('job_status_change', [$job->id]) }}" class="text-dark">
						@if($job->status->id == 1)
						<i class="fa fa-play-circle text-danger m-2"></i>
						@elseif($job->status->id == 2)
						<i class="fa fa-hourglass-half text-warning m-2"></i>
						@elseif($job->status->id == 3)
						<i class="fa fa-check text-success m-2"></i>
						@else
						<i class="fa fa-check-circle text-success m-2"></i>
						@endif
					</a>
					@if($job->trashed())
			            <i class="fa fa-trash-alt text-danger mr-2"></i>
			        @endif
					</h3>
					<p class="desc">
						{{ $job->description }}
					</p>
				</div>

				<div class="col-md-12 col-lg-4">
					<div class="row">
						<div class="progress md-progress mt-3 col-lg-12 px-0" style="height: 20px;">
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
						<div class="deadline col-12 text-center">
							@if(Carbon\Carbon::parse($job->deadline)->diffInDays(false, false) >= 0)
				              <span class="font-weight-bold">
				                <i class="fas fa-skull-crossbones text-danger fa-lg m-2"></i>
				                {{Carbon\Carbon::parse($job->deadline)->diffForHumans(null, false, false, 2)}}
				              </span>
				            @elseif(Carbon\Carbon::parse($job->deadline)->diffInDays(false, false) == 1)
				                <i class="fas fa-exclamation-triangle text-danger fa-lg m-2"></i>
				                {{Carbon\Carbon::parse($job->deadline)->diffForHumans(null, false, false, 2)}}
				            @else
				              <i class="far fa-calendar-check m-2 fa-lg"></i>
				              {{Carbon\Carbon::parse($job->deadline)->diffForHumans(null, false, false, 2)}}
				            @endif
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="card-body">
			<div class="col-lg-12">
				<h5 class="mt-3"><i class="fa fa-list-ol mr-2  text-muted"></i> Zadania:</h5>
				<p>dodaj</p>
				<ul class="list-group">
					@foreach($job->tasks as $task)
					<li class="list-group-item task @if($task->status_id == 4) text-black-30 @elseif($task->status_id == 3) text-black-50 @endif">
						<div class="row">
							<div class="col-lg-9">
								<p><strong>{{ $task->name }}</strong></p>
								<p>{{ $task->description }}</p>
							</div>
							<div class="col-lg-3 text-center">
								<a href="{{ route('task_status_change', [$task->id]) }}" class="text-white btn-floating btn-sm
									@if($task->status_id == 1)
									btn-danger"><i class="fa fa-play-circle"></i>
									@elseif($task->status_id == 2)
									btn-warning"><i class="fa fa-hourglass-half"></i>
									@elseif($task->status_id == 3)
									btn-success"><i class="fa fa-check"></i>
									@else
									btn-success"><i class="fa fa-check-circle"></i>
									@endif
								</a>
								<a href="#" class="text-white btn-floating btn-warning btn-sm mx-2"><i class="fas fa-pencil-alt text-white"></i></a>
								<a href="#" class="text-white btn-floating btn-danger btn-sm"><i class="fa fa-trash-alt text-white"></i></a>
							</div>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>

		<div class="card-footer">
			<a href="{{ route('job_edit', [$job->id]) }}" type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt text-white fa-lg"></i></i></a>
			<a href="{{ route('job_destroy', [$job->id]) }}" type="button" class="btn btn-danger btn-sm mr-4"><i class="fa fa-trash-alt text-white"></i></a>

			<span class="text-muted">
				Utworzone: {{Carbon\Carbon::parse($job->created_at)->diffForHumans(null, false)}}

				@if($job->created_at->getTimestamp() !== $job->updated_at->getTimestamp())
				| aktualizacja: {{Carbon\Carbon::parse($job->updated_at)->diffForHumans(null, false)}}
				@endif

			</span>

		</div>
	</div>
</div>
<div class="container-fluid mt-4">
	<div class="container">
		<!-- Card -->
		<div class="card users">
			<div class="card-header">
				<div class="row">
					<div class="col-md-12">
						<h5><i class="fa fa-user-circle mr-2 text-muted"></i> Użytkownicy:</h5>
					</div>
				</div>
			</div>

			<div class="mx-4 mt-4">
				<h5>
					Dodaj użytkownika:
				</h5>
			</div>

			<div class="card-body">
				<ul class="list-group">
					@forelse($job->user as $user)
					<li class="list-group-item">
						<div class="row">
							<div class="col-lg-9">
								<a href="{{ route('user', [$user->id]) }}" class="text-dark"><i class="fa fa-user-circle fa-lg mt-4 mr-2 text-muted"></i> {{ $user->name }}</a>
							</div>
							<div class="col-lg-3 text-center">
								<a href="{{ route('user', [$user->id]) }}" class="text-white btn-floating btn-info btn-sm"><i class="fa fa-eye text-white"></i></a>
								<a class="text-white btn-floating btn-warning btn-sm mx-2"><i class="fas fa-pencil-alt text-white"></i></a>
								<a class="text-white btn-floating btn-danger btn-sm"><i class="fa fa-trash-alt text-white"></i></a>
							</div>
						</div>
					</li>
					@empty
					<li class="list-group-item">Brak użytkowników.</li>
					@endforelse
				</ul>

			</div>

		</div>
		<!-- Card -->
	</div>
</div>
@endsection