@extends('front.layouts.front')

@section('css')
	<link href="css/addons/datatables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<table id="users_table" class="table table-responsive table-striped">
			<thead>
				<tr>
					<th>Imię</th>
					<th>E-mail</th>
					<th>Projekty</th>
					<th>Zobacz</th>
					<th>Edytuj</th>
					<th>Usuń</th>
				</tr>
			</thead>
			<tbody>
				@forelse($users as $user)
					<tr>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ count($user->jobs) }}</td>
						<td><a href="{{ route('user', [$user->id]) }}" type="button" class="btn btn-default btn-sm"><i class="fa fa-eye text-white fa-lg"></i></a></td>
						<td><a href="#" type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit text-white fa-lg"></i></a></td>
						<td><a href="#"type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt text-white fa-lg"></i></a></td>
					</tr>
				@empty 
					<p>Brak użytkowników.</p>
				@endforelse
			</tbody>
		</table>
	</div>
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