<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('file_uploads', function(Blueprint $table)
		{
			$table->increments('file_uploads_id');
			$table->smallInteger('file_uploads_master_fk');
			$table->smallInteger('file_uploads_users_fk');
			$table->string('file_uploads_path');
			$table->string('file_uploads_name');
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
		Schema::drop('file_uploads');
	}

}
