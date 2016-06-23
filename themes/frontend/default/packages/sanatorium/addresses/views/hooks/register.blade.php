
<div>

	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="fakturacni-header">
			<h4 class="panel-title">
				<a class="btn-block" role="button" data-toggle="collapse" data-parent="#accordion" href="#fakturacni-udaje" aria-expanded="true" aria-controls="fakturacni-udaje">
					{{ trans('sanatorium/orders::cart.billing.title') }}
				</a>
			</h4>
		</div>
		<div id="fakturacni-udaje" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="fakturacni-header">
			<div class="panel-body">

				<input type="hidden" name="address[fakturacni][label]" value="Fakturační adresa">

				<div class="form-group">
					<div class="col-sm-4">
						<label for="name" class="control-label">{{ trans('sanatorium/orders::cart.billing.name') }}</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="address[fakturacni][name]" id="name">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label for="street" class="control-label">{{ trans('sanatorium/orders::cart.billing.street') }}</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="address[fakturacni][street]" id="street">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label for="city" class="control-label">{{ trans('sanatorium/orders::cart.billing.city') }}</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="address[fakturacni][city]" id="city">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label for="postcode" class="control-label">{{ trans('sanatorium/orders::cart.billing.zip') }}</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="address[fakturacni][postcode]" id="postcode">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label for="country" class="control-label">{{ trans('sanatorium/orders::cart.billing.country') }}</label>
					</div>
					<div class="col-sm-8">
						@if ( isset($deliveryCountries) )
							<select name="address[fakturacni][country]" id="country" class="form-control">
								@foreach( $deliveryCountries as $country )
									@if ( isset($suggestedCountries) )
										<option value="{{ $country->name_simple }}" {{ $suggestedCountries['fakturacni'] == $country->name_simple ? 'selected' : '' }}>
											<?php
											if ( App::getLocale() == 'cs' ) {
												switch( strtolower($country->name_simple) ) {
													case 'czech republic':
														echo 'Česká republika';
													break;
													case 'slovakia':
														echo 'Slovensko';
													break;
												}
											} else {
												echo $country->name_simple;
											}
											?>
										</option>
									@else
										<option value="{{ $country->name_simple }}">
											<?php
											if ( App::getLocale() == 'cs' ) {
												switch( strtolower($country->name_simple) ) {
													case 'czech republic':
														echo 'Česká republika';
													break;
													case 'slovakia':
														echo 'Slovensko';
													break;
												}
											} else {
												echo $country->name_simple;
											}
											?>
										</option>
									@endif
								@endforeach
							</select>
						@else
							<select name="address[fakturacni][country]" id="country" class="form-control">
								@if ( isset($suggestedCountries) )
								<option value="Česká republika" {{ $suggestedCountries['fakturacni'] == 'Česká republika' ? 'selected' : '' }}>Česká republika</option>
								<option value="Slovensko"  {{ $suggestedCountries['fakturacni'] == 'Slovensko' ? 'selected' : '' }}>Slovensko</option>
								@else
								<option value="Česká republika">Česká republika</option>
								<option value="Slovensko">Slovensko</option>
								@endif
							</select>
						@endif
					</div>
				</div>
				
			</div>
		</div>
	 </div>

	 <div class="panel panel-default">
		<div class="panel-heading" role="tab" id="dodaci-header">
			<h4 class="panel-title">
				<a class="btn-block" role="button" data-toggle="collapse" data-parent="#accordion" href="#dodaci-udaje" aria-expanded="true" aria-controls="dodaci-udaje">
					{{ trans('sanatorium/orders::cart.delivery.title') }}
				</a>
			</h4>
		</div>
		<div id="dodaci-udaje" class="panel-collapse collapse" role="tabpanel" aria-labelledby="dodaci-header">
			<div class="panel-body">
				
				<input type="hidden" name="address[dodaci][label]" value="Dodací adresa">

				<div class="form-group">
					<div class="col-sm-4">
						<label for="dodaci-name" class="control-label">{{ trans('sanatorium/orders::cart.delivery.name') }}</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="address[dodaci][name]" id="dodaci-name">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label for="dodaci-street" class="control-label">{{ trans('sanatorium/orders::cart.delivery.street') }}</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="address[dodaci][street]" id="dodaci-street">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label for="dodaci-city" class="control-label">{{ trans('sanatorium/orders::cart.delivery.city') }}</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="address[dodaci][city]" id="dodaci-city">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label for="dodaci-postcode" class="control-label">{{ trans('sanatorium/orders::cart.delivery.zip') }}</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="address[dodaci][postcode]" id="dodaci-postcode">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label for="dodaci-country" class="control-label">{{ trans('sanatorium/orders::cart.delivery.country') }}</label>
					</div>
					<div class="col-sm-8">
						@if ( isset($deliveryCountries) )
							<select name="address[dodaci][country]" id="country" class="form-control">
								@foreach( $deliveryCountries as $country )
									@if ( isset($suggestedCountries) )
										<option value="{{ $country->name_simple }}" {{ $suggestedCountries['dodaci'] == $country->name_simple ? 'selected' : '' }}>
											<?php
											if ( App::getLocale() == 'cs' ) {
												switch( strtolower($country->name_simple) ) {
													case 'czech republic':
														echo 'Česká republika';
													break;
													case 'slovakia':
														echo 'Slovensko';
													break;
												}
											} else {
												echo $country->name_simple;
											}
											?>
										</option>
									@else
										<option value="{{ $country->name_simple }}">
											<?php
											if ( App::getLocale() == 'cs' ) {
												switch( strtolower($country->name_simple) ) {
													case 'czech republic':
														echo 'Česká republika';
													break;
													case 'slovakia':
														echo 'Slovensko';
													break;
												}
											} else {
												echo $country->name_simple;
											}
											?>
										</option>
									@endif
								@endforeach
							</select>
						@else
							<select name="address[dodaci][country]" id="country" class="form-control">
								@if ( isset($suggestedCountries) )
								<option value="Česká republika" {{ $suggestedCountries['dodaci'] == 'Česká republika' ? 'selected' : '' }}>Česká republika</option>
								<option value="Slovensko"  {{ $suggestedCountries['dodaci'] == 'Slovensko' ? 'selected' : '' }}>Slovensko</option>
								@else
								<option value="Česká republika">Česká republika</option>
								<option value="Slovensko">Slovensko</option>
								@endif
							</select>
						@endif
					</div>
				</div>
			</div>
		</div>
	 </div>

	 <div class="panel panel-default">
		<div class="panel-heading" role="tab" id="firemni-header">
			<h4 class="panel-title">
				<a class="btn-block" role="button" data-toggle="collapse" data-parent="#accordion" href="#firemni-udaje" aria-expanded="true" aria-controls="firemni-udaje">
					{{ trans('sanatorium/orders::cart.company.title') }}
				</a>
			</h4>
		</div>
		<div id="firemni-udaje" class="panel-collapse collapse" role="tabpanel" aria-labelledby="firemni-header">
			<div class="panel-body">
				<div class="form-group">
					<div class="col-sm-4">
						<label for="ic" class="control-label">{{ trans('sanatorium/orders::cart.company.ic') }}</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="address[fakturacni][ic]" id="ic">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label for="dic" class="control-label">{{ trans('sanatorium/orders::cart.company.dic') }}</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="address[fakturacni][dic]" id="dic">
					</div>
				</div>
			</div>
		</div>
	 </div>

</div>