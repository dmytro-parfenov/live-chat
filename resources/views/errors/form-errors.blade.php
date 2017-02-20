	@if( $errors->any() )

		<div class="col-xs-12">
			<ul class="alert alert-danger">
				@foreach( $errors->all() as $error )
					<li>{{ $error }}
				@endforeach
			</ul>
		</div>

	@endif