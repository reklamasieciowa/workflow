@extends('front.layouts.front')

@section('css')
	<link href="css/addons/datatables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container" id="users_table">
	@forelse($users as $user)
		<div class="row">
			<div class="col-lg-3">
				{{ $user->name }}
			</div>
			<div class="col-lg-3">
				{{ $user->email }}
			</div>
			<div class="col-lg-3">
				Projekty: {{ count($user->jobs) }}
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


@section('footer_js')
	<script type="text/javascript" src="js/addons/datatables.min.js"></script>

	<script>
		$(document).ready(function () {
			$('#users_table').DataTable({
				"language": {
				    "processing":     "Przetwarzanie...",
				    "search":         "Szukaj:",
				    "lengthMenu":     "Pokaż _MENU_ pozycji",
				    "info":           "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
				    "infoEmpty":      "Pozycji 0 z 0 dostępnych",
				    "infoFiltered":   "(filtrowanie spośród _MAX_ dostępnych pozycji)",
				    "infoPostFix":    "",
				    "loadingRecords": "Wczytywanie...",
				    "zeroRecords":    "Nie znaleziono pasujących pozycji",
				    "emptyTable":     "Brak danych",
				    "paginate": {
				        "first":      "Pierwsza",
				        "previous":   "Poprzednia",
				        "next":       "Następna",
				        "last":       "Ostatnia"
				    },
				    "aria": {
				        "sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
				        "sortDescending": ": aktywuj, by posortować kolumnę malejąco"
				    }
				},
				"pageLength": 25
			});
			$('.dataTables_length').addClass('bs-select');
		});
	</script>
@endsection