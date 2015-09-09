<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecommendedLandsTable extends Migration {

	public function up(){
		Schema::create('recommended_lands', function(Blueprint $table)		{
			$table->increments('id');
			$table->integer('land_id')->default(0)->unsigned()->nullable();
			$table->integer('recommended_land_id')->default(0)->unsigned()->nullable();
			$table->timestamps();
		});
	}

	public function down(){
		Schema::drop('recommended_lands');
	}

}
