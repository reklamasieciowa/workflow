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

		<h5 class="card-header text-center py-4">
        	<strong><i class="fas fa-tag mr-2"></i> {{$job->name}}</strong>
        	@if($job->trashed())
			    <i class="fa fa-trash-alt text-danger fa-lg ml-2"></i>
			 @endif
    	</h5>
		<div class="card-body">
		<form action="{{ route('job_update', [$job->id]) }}" method="POST">
			@csrf
			<div class="md-form mb-4">
				<h5><i class="fas fa-tag mr-2 text-muted"></i> Projekt:</h5>
			</div>
			<div class="md-form mt-3">
                <input type="text" id="name" name="name" class="form-control" value="{{$job->name}}">
                <label for="name">Nazwa</label>
            </div>

            <div class="md-form mt-3">
                <input type="text" id="description" name="description" class="form-control" value="{{$job->description}}">
                <label for="decsription">Opis</label>
            </div>

            <div class="md-form mt-3">
			  <input placeholder="Deadline" type="text" id="deadline" name="deadline" class="form-control datepicker" value="{{$job->deadline}}">
			  <label for="deadline">Deadline</label>
			</div>
			
			<div class="md-form mt-3 mb-2">
				<h5><i class="fa fa-list-ol mr-2 text-muted"></i> Zadania:</h5>
			</div>

			checklist
			@foreach($job->tasks as $task)
			
			<input type="hidden" id="tasks[{{$task->id}}][id]" name="tasks[{{$task->id}}][id]" value="{{ $task->id }}">
				<div class="row mx-2 my-2 grey lighten-4 px-2">
					<div class="col-lg-6 md-form">
					  <input placeholder="Nazwa" type="text" id="tasks[{{$task->id}}][name]" name="tasks[{{$task->id}}][name]" class="form-control" value="{{ $task->name }}">
					  <label for="task-name">Nazwa</label>
					</div>
					<div class="col-lg-6 md-form">
					  <input placeholder="Opis" type="text" id="tasks[{{$task->id}}][description]" name="tasks[{{$task->id}}][description]" class="form-control" value="{{ $task->description }}">
					  <label for="task-description">Opis</label>
					</div>
				</div>
	
			@endforeach

			<button class="btn btn-info my-4" type="submit">Zapisz</button>
		</form>

		



<!-- 		<div class="col-12 users my-4">
			<h5 class="mt-3">Użytkownicy:</h5>
			<ul class="list-group">
				@forelse($job->user as $user)
				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-9">
							<a href="{{ route('user', [$user->id]) }}" class="text-dark"><i class="fa fa-user-circle fa-lg m-2"></i> {{ $user->name }}</a>
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
		</div> -->
		</div>
		<div class="card-footer">
			<a href="{{ route('job', [$job->id]) }}" type="button" class="btn btn-info btn-sm mx-2"><i class="fa fa-eye text-white"></i></a>
			<a type="button" class="btn btn-danger btn-sm mr-4"><i class="fa fa-trash-alt text-white"></i></a>
			<span class="text-muted">
				Utworzone: {{Carbon\Carbon::parse($job->created_at)->diffForHumans(null, false)}}

				@if($job->created_at->getTimestamp() !== $job->updated_at->getTimestamp())
				| aktualizacja: {{Carbon\Carbon::parse($job->updated_at)->diffForHumans(null, false)}}
				@endif

			</span>

		</div>

	</div>
</div>
@endsection