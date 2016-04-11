<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->nullable();
			$table->text('label')->nullable();
			$table->text('name')->nullable();
			$table->text('address_line_1')->nullable();
			$table->text('address_line_2')->nullable();
			$table->text('address_line_3')->nullable();
			$table->string('postcode')->nullable();
			$table->string('country')->nullable();
			$table->string('city')->nullable();
			$table->string('street')->nullable();
			$table->string('street_number')->nullable();
			$table->string('ic')->nullable();
			$table->string('dic')->nullable();
			$table->string('type')->nullable();
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
		Schema::drop('addresses');
	}

}
