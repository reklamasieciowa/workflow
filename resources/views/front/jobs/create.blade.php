@extends('front.layouts.front')

@section('content')

<div class="container">
	<div class="card job">

		<h5 class="card-header text-center py-4">
        	<strong><i class="fas fa-tag mr-2"></i> Dodaj nowy projekt</strong>
    	</h5>
		<div class="card-body">
		<form action="{{ route('job_store') }}" method="POST" class="needs-validation" novalidate>
			@csrf
			<div class="md-form mb-4">
				<h5><i class="fas fa-tag mr-2 text-muted"></i> Projekt:</h5>
			</div>
			<div class="md-form mt-3">
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                <label for="name">Nazwa</label>
                 @if ($errors->has('name'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                 @endif
            </div>

            <div class="md-form mt-3">
                <input type="text" id="description" name="description" class="form-control" value="{{ old('description') }}">
                <label for="decsription">Opis</label>
                @if ($errors->has('description'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </div>
                 @endif
            </div>

            <div class="md-form mt-3">
			  <input type="text" id="deadline" name="deadline" class="form-control datepicker" value="{{ old('deadline') }}">
			  <label for="deadline">Deadline</label>
			    @if ($errors->has('deadline'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('deadline') }}</strong>
                    </div>
                 @endif
			</div>

			<div class="md-form mt-5 mb-2">
				<h5><i class="fa fa-list-ol mr-2 text-muted"></i> Zadania:</h5>
			</div>

			<div class="mt-3 mb-2">
				<div class="form-check">
				  <input type="checkbox" class="form-check-input" id="checklist" name="checklist">
				  <label class="form-check-label" for="checklist">Dodaj zadania z checklisty</label>
				</div>
			</div>

			<div id="form-tasks" class="mt-3 mb-2 col-lg-12">
				
			</div>

			<div class="row mx-1">
				<div class="md-form col-lg-5 mt-3">
				  <input type="text" id="task-name-def" class="form-control">
				  <label for="task-name-def">Nazwa</label>
				</div>
				<div class="md-form col-lg-5 mt-3">
				  <input type="text" id="task-description-def" class="form-control">
				  <label for="task-description-def">Opis</label>
				</div>
				<div class="md-form col-lg-2 mt-3">
					<a id="addTask" class="btn btn-sm btn-info mx-0 my-2"><i class="fas fa-save"></i> Dodaj</a>
				</div>
			</div>

			<div class="md-form mt-3 mb-2">
				<h5><i class="fa fa-user-circle mr-2 text-muted"></i> Użytkownicy:</h5>
			</div>

			<div id="form-users" class="mt-3 mb-2 col-lg-12">
				
			</div>

			<div class="row mx-1">
				<div class="col-lg-10">
				<select class="mdb-select md-form" id="user-name-def" searchable="Szukaj...">
					<option value="" disabled selected>Użytkownik</option>
					@foreach($users as $user)
						<option value="{{ $user->id }}">{{ $user->name }}</option>
					@endforeach
				</select>
				</div>
				<div class="md-form col-lg-2 mt-3">
					<a id="addUser" class="btn btn-sm btn-info mx-0 my-2"><i class="fas fa-save"></i> Dodaj</a>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<button class="btn btn-success mx-0 my-2" type="submit"><i class="fas fa-save"></i> Zapisz</button>
			</form>
		</div>

	</div>
</div>
@endsection