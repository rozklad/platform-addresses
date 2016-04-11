@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{{ trans("action.{$mode}") }}} {{ trans('sanatorium/addresses::countries/common.title') }}
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

						<a class="btn btn-navbar-cancel navbar-btn pull-left tip" href="{{ route('admin.sanatorium.addresses.countries.all') }}" data-toggle="tooltip" data-original-title="{{{ trans('action.cancel') }}}">
							<i class="fa fa-reply"></i> <span class="visible-xs-inline">{{{ trans('action.cancel') }}}</span>
						</a>

						<span class="navbar-brand">{{{ trans("action.{$mode}") }}} <small>{{{ $countries->exists ? $countries->id : null }}}</small></span>
					</div>

					{{-- Form: Actions --}}
					<div class="collapse navbar-collapse" id="actions">

						<ul class="nav navbar-nav navbar-right">

							@if ($countries->exists)
							<li>
								<a href="{{ route('admin.sanatorium.addresses.countries.delete', $countries->id) }}" class="tip" data-action-delete data-toggle="tooltip" data-original-title="{{{ trans('action.delete') }}}" type="delete">
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
					<li class="active" role="presentation"><a href="#general-tab" aria-controls="general-tab" role="tab" data-toggle="tab">{{{ trans('sanatorium/addresses::countries/common.tabs.general') }}}</a></li>
					<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab">{{{ trans('sanatorium/addresses::countries/common.tabs.attributes') }}}</a></li>
				</ul>

				<div class="tab-content">

					{{-- Tab: General --}}
					<div role="tabpanel" class="tab-pane fade in active" id="general-tab">

						<fieldset>

							<div class="row">

								<div class="form-group{{ Alert::onForm('name_simple', ' has-error') }}">

									<label for="name_simple" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.name_simple_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.name_simple') }}}
									</label>

									<input type="text" class="form-control" name="name_simple" id="name_simple" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.name_simple') }}}" value="{{{ input()->old('name_simple', $countries->name_simple) }}}">

									<span class="help-block">{{{ Alert::onForm('name_simple') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('name', ' has-error') }}">

									<label for="name" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.name_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.name') }}}
									</label>

									<textarea class="form-control" name="name" id="name" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.name') }}}">{{{ input()->old('name', $countries->name) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('name') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('cca2', ' has-error') }}">

									<label for="cca2" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.cca2_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.cca2') }}}
									</label>

									<input type="text" class="form-control" name="cca2" id="cca2" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.cca2') }}}" value="{{{ input()->old('cca2', $countries->cca2) }}}">

									<span class="help-block">{{{ Alert::onForm('cca2') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('ccn3', ' has-error') }}">

									<label for="ccn3" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.ccn3_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.ccn3') }}}
									</label>

									<input type="text" class="form-control" name="ccn3" id="ccn3" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.ccn3') }}}" value="{{{ input()->old('ccn3', $countries->ccn3) }}}">

									<span class="help-block">{{{ Alert::onForm('ccn3') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('cca3', ' has-error') }}">

									<label for="cca3" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.cca3_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.cca3') }}}
									</label>

									<input type="text" class="form-control" name="cca3" id="cca3" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.cca3') }}}" value="{{{ input()->old('cca3', $countries->cca3) }}}">

									<span class="help-block">{{{ Alert::onForm('cca3') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('cioc', ' has-error') }}">

									<label for="cioc" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.cioc_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.cioc') }}}
									</label>

									<input type="text" class="form-control" name="cioc" id="cioc" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.cioc') }}}" value="{{{ input()->old('cioc', $countries->cioc) }}}">

									<span class="help-block">{{{ Alert::onForm('cioc') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('currency', ' has-error') }}">

									<label for="currency" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.currency_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.currency') }}}
									</label>

									<textarea class="form-control" name="currency" id="currency" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.currency') }}}">{{{ input()->old('currency', $countries->currency) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('currency') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('callingCode', ' has-error') }}">

									<label for="callingCode" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.callingCode_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.callingCode') }}}
									</label>

									<textarea class="form-control" name="callingCode" id="callingCode" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.callingCode') }}}">{{{ input()->old('callingCode', $countries->callingCode) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('callingCode') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('capital', ' has-error') }}">

									<label for="capital" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.capital_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.capital') }}}
									</label>

									<input type="text" class="form-control" name="capital" id="capital" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.capital') }}}" value="{{{ input()->old('capital', $countries->capital) }}}">

									<span class="help-block">{{{ Alert::onForm('capital') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('altSpellings', ' has-error') }}">

									<label for="altSpellings" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.altSpellings_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.altSpellings') }}}
									</label>

									<textarea class="form-control" name="altSpellings" id="altSpellings" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.altSpellings') }}}">{{{ input()->old('altSpellings', $countries->altSpellings) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('altSpellings') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('region', ' has-error') }}">

									<label for="region" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.region_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.region') }}}
									</label>

									<input type="text" class="form-control" name="region" id="region" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.region') }}}" value="{{{ input()->old('region', $countries->region) }}}">

									<span class="help-block">{{{ Alert::onForm('region') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('subregion', ' has-error') }}">

									<label for="subregion" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.subregion_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.subregion') }}}
									</label>

									<input type="text" class="form-control" name="subregion" id="subregion" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.subregion') }}}" value="{{{ input()->old('subregion', $countries->subregion) }}}">

									<span class="help-block">{{{ Alert::onForm('subregion') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('tld', ' has-error') }}">

									<label for="tld" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.tld_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.tld') }}}
									</label>

									<textarea class="form-control" name="tld" id="tld" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.tld') }}}">{{{ input()->old('tld', $countries->tld) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('tld') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('languages', ' has-error') }}">

									<label for="languages" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.languages_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.languages') }}}
									</label>

									<textarea class="form-control" name="languages" id="languages" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.languages') }}}">{{{ input()->old('languages', $countries->languages) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('languages') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('translations', ' has-error') }}">

									<label for="translations" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.translations_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.translations') }}}
									</label>

									<textarea class="form-control" name="translations" id="translations" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.translations') }}}">{{{ input()->old('translations', $countries->translations) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('translations') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('latlng', ' has-error') }}">

									<label for="latlng" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.latlng_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.latlng') }}}
									</label>

									<textarea class="form-control" name="latlng" id="latlng" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.latlng') }}}">{{{ input()->old('latlng', $countries->latlng) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('latlng') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('demonym', ' has-error') }}">

									<label for="demonym" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.demonym_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.demonym') }}}
									</label>

									<input type="text" class="form-control" name="demonym" id="demonym" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.demonym') }}}" value="{{{ input()->old('demonym', $countries->demonym) }}}">

									<span class="help-block">{{{ Alert::onForm('demonym') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('landlocked', ' has-error') }}">

									<label for="landlocked" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.landlocked_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.landlocked') }}}
									</label>

									<div class="checkbox">
										<label>
											<input type="hidden" name="landlocked" id="landlocked" value="0" checked>
											<input type="checkbox" name="landlocked" id="landlocked" @if($countries->landlocked) checked @endif value="1"> {{ ucfirst('landlocked') }}
										</label>
									</div>

									<span class="help-block">{{{ Alert::onForm('landlocked') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('borders', ' has-error') }}">

									<label for="borders" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.borders_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.borders') }}}
									</label>

									<textarea class="form-control" name="borders" id="borders" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.borders') }}}">{{{ input()->old('borders', $countries->borders) }}}</textarea>

									<span class="help-block">{{{ Alert::onForm('borders') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('area', ' has-error') }}">

									<label for="area" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.area_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.area') }}}
									</label>

									<input type="text" class="form-control" name="area" id="area" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.area') }}}" value="{{{ input()->old('area', $countries->area) }}}">

									<span class="help-block">{{{ Alert::onForm('area') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('code', ' has-error') }}">

									<label for="code" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.code_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.code') }}}
									</label>

									<input type="text" class="form-control" name="code" id="code" placeholder="{{{ trans('sanatorium/addresses::countries/model.general.code') }}}" value="{{{ input()->old('code', $countries->code) }}}">

									<span class="help-block">{{{ Alert::onForm('code') }}}</span>

								</div>

								<div class="form-group{{ Alert::onForm('delivering', ' has-error') }}">

									<label for="delivering" class="control-label">
										<i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('sanatorium/addresses::countries/model.general.delivering_help') }}}"></i>
										{{{ trans('sanatorium/addresses::countries/model.general.delivering') }}}
									</label>

									<div class="checkbox">
										<label>
											<input type="hidden" name="delivering" id="delivering" value="0" checked>
											<input type="checkbox" name="delivering" id="delivering" @if($countries->delivering) checked @endif value="1"> {{ ucfirst('delivering') }}
										</label>
									</div>

									<span class="help-block">{{{ Alert::onForm('delivering') }}}</span>

								</div>


							</div>

						</fieldset>

					</div>

					{{-- Tab: Attributes --}}
					<div role="tabpanel" class="tab-pane fade" id="attributes">
						@attributes($countries)
					</div>

				</div>

			</div>

		</div>

	</form>

</section>
@stop
