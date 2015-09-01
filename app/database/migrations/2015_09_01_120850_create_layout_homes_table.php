<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLayoutHomesTable extends Migration {

	public function up(){
		Schema::create('layout_homes', function(Blueprint $table){
			$table->increments('id');

			$table->string('title', 100)->nullable();
			$table->string('contractor_title', 100)->nullable();
			$table->string('contractor_link', 100)->nullable();
			$table->string('construction_period', 100)->nullable();
			$table->double('area')->default(0)->unsigned()->nullable();
			$table->string('material', 100)->nullable();
			$table->double('price')->default(0)->unsigned()->nullable();
			$table->integer('land_id')->default(0)->unsigned()->nullable();

			$table->integer('photo_id')->unsigned()->nullable();
			$table->integer('gallery_id')->unsigned()->nullable();

			$table->timestamps();
		});
	}

	public function down(){
		Schema::drop('layout_homes');
	}
}
