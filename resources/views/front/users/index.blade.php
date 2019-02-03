@extends('front.layouts.front')

@section('css')
	<link href="css/addons/datatables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container users">
	<div class="row">
		<div class="col-lg-6">
			<div class="md-form mt-3">
				<input type="text" id="search" class="form-control">
				<label for="search">Szukaj</label>
			</div>
		</div>
		<div class="col-lg-6">
			Użytkownicy: <span id="count-total">{{ $total }}</span>
		</div>
	</div>
	@forelse($users as $user)
		<div class="row user searchable">
			<div class="col-lg-3">
				<p>{{ $user->name }}</p>
			</div>
			<div class="col-lg-3">
				<p>{{ $user->email }}</p>
			</div>
			<div class="col-lg-3">
				<p><i class="fas fa-tag mr-2 text-muted"></i> {{ count($user->jobs) }}</p>
			</div>
			<div class="col-lg-3">
				<a href="{{ route('user', [$user->id]) }}" type="button" class="btn btn-default btn-sm"><i class="fa fa-eye text-white fa-lg"></i></a> 
				<a href="#" type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit text-white fa-lg"></i></a> 
				<a href="#"type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt text-white fa-lg"></i></a>
			</div>
		</div>
	@empty 
		<div class="row">
			<div class="col-lg-12 text-center">
				<p>Brak użytkowników.</p>
			</div>
		</div>
	@endforelse
</div>

@endsection