<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name_simple')->nullable();
			$table->text('name')->nullable();
			$table->string('cca2')->nullable();
			$table->string('ccn3')->nullable();
			$table->string('cca3')->nullable();
			$table->string('cioc')->nullable();
			$table->text('currency')->nullable();
			$table->text('callingCode')->nullable();
			$table->string('capital')->nullable();
			$table->text('altSpellings')->nullable();
			$table->string('region')->nullable();
			$table->string('subregion')->nullable();
			$table->text('tld')->nullable();
			$table->text('languages')->nullable();
			$table->text('translations')->nullable();
			$table->text('latlng')->nullable();
			$table->string('demonym')->nullable();
			$table->boolean('landlocked');
			$table->text('borders')->nullable();
			$table->integer('area')->nullable();
			$table->string('code')->nullable();
			$table->boolean('delivering');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('countries');
	}

}
