@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{{ trans("action.{$mode}") }}} {{ trans('sanatorium/addresses::addresses/common.title') }}
@stop

{{-- Queue assets --}}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
@stop

{{-- Inline styles --}}
@section('styles')
@parent
@stop

{{-- Page content --}}
@section('page')

<section class="panel panel-default panel-tabs">

	{{-- Form --}}
	<form id="addresses-form" action="{{ request()->fullUrl() }}" role="form" method="post" data-parsley-validate>

		{{-- Form: CSRF Token --}}
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<header class="panel-heading">

			<nav class="navbar navbar-default navbar-actions">

				<div class="container-fluid">

					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#actions">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<a class="btn btn-navbar-cancel navbar-btn pull-left tip" href="{{ route('admin.sanatorium.addresses.addresses.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
							<i class="fa fa-reply"></i> <span class="visible-xs-inline">{{{ trans('action.cancel') }}}</span>
						</a>

						<span class="navbar-brand">{{{ trans("action.{$mode}") }}} <small>{{{ $address->exists ? $address->id : null }}}</small></span>
					</div>

					{{-- Form: Actions --}}
					<div class="collapse navbar-collapse" id="actions">

						<ul class="nav navbar-nav navbar-right">

							@if ($address->exists)
							<li>
								<a href="{{ route('admin.sanatorium.addresses.addresses.delete', $address->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
									<i class="fa fa-trash-o"></i> <span class="visible-xs-inline">{{{ trans('action.delete') }}}</span>
								</a>
							</li>
							@endif

							<li>
								<button class="btn btn-primary navbar-btn" data-toggle="tooltip" data-original-title="{{{ trans('action.save') }}}">
									<i class="fa fa-save"></i> <span class="visible-xs-inline">{{{ trans('action.save') }}}</span>
								</button>
							</li>

						</ul>

					</div>

				</div>

			</nav>

		</header>

		<div class="panel-body">

			<div role="tabpanel">

				{{-- Form: Tabs --}}
				<ul class="nav nav-tabs" role="tablist">
					<li class="active" role="presentation"><a href="#general-tab" aria-controls="general-tab" role="tab" data-toggle="tab">{{{ trans('sanatorium/addresses::addresses/common.tabs.general') }}}</a></li>
					<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">{{{ trans('sanatorium/addresses::addresses/common.tabs.attributes') }}}</a></li>
				</ul>

				<div class="tab-content">

					{{-- Tab: General --}}
					<div role="tabpanel" class="tab-pane fade in active" id="general-tab">

						<fieldset>

							<div class="row">

								<div class="form-group{{ Alert::onForm('label', ' has-error') }}">

									<label for="label" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::addresses/model.general.label_help') }}}"></i>
										{{{ trans('sanatorium/addresses::addresses/model.general.label') }}}
									</label>

									<textarea class="form-control" name="label" id="label" placeholder="{{{ trans('sanatorium/addresses::addresses/model.general.label') }}}">{{{ input()->old('label', $address->label) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('label') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('name', ' has-error') }}">

									<label for="name" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::addresses/model.general.name_help') }}}"></i>
										{{{ trans('sanatorium/addresses::addresses/model.general.name') }}}
									</label>

									<textarea class="form-control" name="name" id="name" placeholder="{{{ trans('sanatorium/addresses::addresses/model.general.name') }}}">{{{ input()->old('name', $address->name) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('name') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('address_line_1', ' has-error') }}">

									<label for="address_line_1" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::addresses/model.general.address_line_1_help') }}}"></i>
										{{{ trans('sanatorium/addresses::addresses/model.general.address_line_1') }}}
									</label>

									<textarea class="form-control" name="address_line_1" id="address_line_1" placeholder="{{{ trans('sanatorium/addresses::addresses/model.general.address_line_1') }}}">{{{ input()->old('address_line_1', $address->address_line_1) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('address_line_1') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('address_line_2', ' has-error') }}">

									<label for="address_line_2" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::addresses/model.general.address_line_2_help') }}}"></i>
										{{{ trans('sanatorium/addresses::addresses/model.general.address_line_2') }}}
									</label>

									<textarea class="form-control" name="address_line_2" id="address_line_2" placeholder="{{{ trans('sanatorium/addresses::addresses/model.general.address_line_2') }}}">{{{ input()->old('address_line_2', $address->address_line_2) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('address_line_2') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('address_line_3', ' has-error') }}">

									<label for="address_line_3" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::addresses/model.general.address_line_3_help') }}}"></i>
										{{{ trans('sanatorium/addresses::addresses/model.general.address_line_3') }}}
									</label>

									<textarea class="form-control" name="address_line_3" id="address_line_3" placeholder="{{{ trans('sanatorium/addresses::addresses/model.general.address_line_3') }}}">{{{ input()->old('address_line_3', $address->address_line_3) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('address_line_3') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('postcode', ' has-error') }}">

									<label for="postcode" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::addresses/model.general.postcode_help') }}}"></i>
										{{{ trans('sanatorium/addresses::addresses/model.general.postcode') }}}
									</label>

									<input type="text" class="form-control" name="postcode" id="postcode" placeholder="{{{ trans('sanatorium/addresses::addresses/model.general.postcode') }}}" value="{{{ input()->old('postcode', $address->postcode) }}}">

									<span class="help-block">{{{ Alert::onForm('postcode') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('country', ' has-error') }}">

									<label for="country" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::addresses/model.general.country_help') }}}"></i>
										{{{ trans('sanatorium/addresses::addresses/model.general.country') }}}
									</label>

									<input type="text" class="form-control" name="country" id="country" placeholder="{{{ trans('sanatorium/addresses::addresses/model.general.country') }}}" value="{{{ input()->old('country', $address->country) }}}">

									<span class="help-block">{{{ Alert::onForm('country') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('city', ' has-error') }}">

									<label for="city" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::addresses/model.general.city_help') }}}"></i>
										{{{ trans('sanatorium/addresses::addresses/model.general.city') }}}
									</label>

									<input type="text" class="form-control" name="city" id="city" placeholder="{{{ trans('sanatorium/addresses::addresses/model.general.city') }}}" value="{{{ input()->old('city', $address->city) }}}">

									<span class="help-block">{{{ Alert::onForm('city') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('street', ' has-error') }}">

									<label for="street" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::addresses/model.general.street_help') }}}"></i>
										{{{ trans('sanatorium/addresses::addresses/model.general.street') }}}
									</label>

									<input type="text" class="form-control" name="street" id="street" placeholder="{{{ trans('sanatorium/addresses::addresses/model.general.street') }}}" value="{{{ input()->old('street', $address->street) }}}">

									<span class="help-block">{{{ Alert::onForm('street') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('street_number', ' has-error') }}">

									<label for="street_number" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::addresses/model.general.street_number_help') }}}"></i>
										{{{ trans('sanatorium/addresses::addresses/model.general.street_number') }}}
									</label>

									<input type="text" class="form-control" name="street_number" id="street_number" placeholder="{{{ trans('sanatorium/addresses::addresses/model.general.street_number') }}}" value="{{{ input()->old('street_number', $address->street_number) }}}">

									<span class="help-block">{{{ Alert::onForm('street_number') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('ic', ' has-error') }}">

									<label for="ic" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::addresses/model.general.ic_help') }}}"></i>
										{{{ trans('sanatorium/addresses::addresses/model.general.ic') }}}
									</label>

									<input type="text" class="form-control" name="ic" id="ic" placeholder="{{{ trans('sanatorium/addresses::addresses/model.general.ic') }}}" value="{{{ input()->old('ic', $address->ic) }}}">

									<span class="help-block">{{{ Alert::onForm('ic') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('dic', ' has-error') }}">

									<label for="dic" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::addresses/model.general.dic_help') }}}"></i>
										{{{ trans('sanatorium/addresses::addresses/model.general.dic') }}}
									</label>

									<input type="text" class="form-control" name="dic" id="dic" placeholder="{{{ trans('sanatorium/addresses::addresses/model.general.dic') }}}" value="{{{ input()->old('dic', $address->dic) }}}">

									<span class="help-block">{{{ Alert::onForm('dic') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('type', ' has-error') }}">

									<label for="type" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::addresses/model.general.type_help') }}}"></i>
										{{{ trans('sanatorium/addresses::addresses/model.general.type') }}}
									</label>

									<input type="text" class="form-control" name="type" id="type" placeholder="{{{ trans('sanatorium/addresses::addresses/model.general.type') }}}" value="{{{ input()->old('type', $address->type) }}}">

									<span class="help-block">{{{ Alert::onForm('type') }}}</span>

								</div>


							</div>

						</fieldset>

					</div>

					{{-- Tab: Attributes --}}
					<div role="tabpanel" class="tab-pane fade" id="attributes">
						@attributes($address)
					</div>

				</div>

			</div>

		</div>

	</form>

</section>
@stop
