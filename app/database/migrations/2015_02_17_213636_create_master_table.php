<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('master', function(Blueprint $table)
		{
			$table->increments('master_id');
			$table->string('master_description');
			$table->tinyInteger('master_users_fk');
			$table->tinyInteger('master_category_fk');
			$table->tinyInteger('master_priority_fk');
			$table->tinyInteger('master_status_fk');
			$table->tinyInteger('master_tech_fk');
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
		Schema::drop('master');
	}

}
