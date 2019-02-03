@extends('front.layouts.front')

@section('content')



<div class="container users">
	<div class="card user">
		<div class="card-header">
			<div class="row">
				<div class="col-lg-6">
					<h4 class="h4-responsive"><i class="fa fa-user-circle mr-2 text-muted"></i> {{$user->name}}</h4>
				</div>
				<div class="col-lg-6">
					<span><i class="fas fa-envelope mr-2 text-muted"></i>{{$user->email}}</span>
				</div>
			</div>
		</div>

		<div class="card-body">
			<div class="col-lg-12">
				<h5 class="mt-3"><i class="fa fa-list-ol mr-2  text-muted"></i> Projekty: {{$total}}</h5>
				@foreach($user->jobs as $job)
				<div class="row">
					<div class="col-lg-6">
						<p><strong>{{$job->name}}</strong> 
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
						</p>
						<p>{{$job->description}}</p>
					</div>
					<div class="col-lg-3">
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
					<div class=col-lg-3">
				         <a href="{{ route('job', [$job->id]) }}" type="button" class="btn btn-default btn-sm"><i class="fa fa-eye text-white fa-lg"></i></a>
				         <a href="{{ route('job_edit', [$job->id]) }}" type="button" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt text-white fa-lg"></i></i></a>
				         <a href="{{ route('job_destroy', [$job->id]) }}" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt text-white fa-lg"></i></a>
				     </div>
				</div>
				@endforeach
			</div>
		</div>

		<div class="card-footer">
			<a href="{{ route('job_edit', [$user->id]) }}" type="button" class="btn btn-default btn-sm"><i class="fas fa-pencil-alt text-white fa-lg"></i></i></a>
			<a href="{{ route('job_destroy', [$user->id]) }}" type="button" class="btn btn-danger btn-sm mr-4"><i class="fa fa-trash-alt text-white"></i></a>

			<span class="text-muted">
				Utworzony: {{Carbon\Carbon::parse($user->created_at)->diffForHumans(null, false)}}

				@if($user->created_at->getTimestamp() !== $user->updated_at->getTimestamp())
				| aktualizacja: {{Carbon\Carbon::parse($user->updated_at)->diffForHumans(null, false)}}
				@endif

			</span>

		</div>
	</div>
</div>
@endsection