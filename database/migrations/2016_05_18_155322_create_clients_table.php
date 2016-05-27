<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
            $table->bigIncrements('id');
	    	$table->string('name', 80);
	    	$table->string('cpf_cnpj', 18);
	    	$table->string('responsible', 50);
	    	$table->string('email', 50);
	    	$table->string('address', 80);
	    	$table->string('neighborhood', 50);
	    	$table->string('number', 10);
	    	$table->string('complement', 50);
	    	$table->string('phone_1', 15);
	    	$table->string('phone_2', 15);
	    	$table->string('zip_code', 9);
	    	$table->string('city', 35);
	    	$table->char('state', 2);
	    	$table->text('obs');

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
		Schema::drop('clients');
	}

}
