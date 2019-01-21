@if (Session::has('status') )
	<div class="container-fluid mt-5">
		<div class="container">
		    <div class="row">
		      <div class="col-lg-12">

				@if(Session::has('status'))
					<div class="alert alert-success mb-0" role="alert">
					    {{session('status')}}
					</div>
				@endif

		      </div>
		    </div>
		</div>
	</div>
@endif