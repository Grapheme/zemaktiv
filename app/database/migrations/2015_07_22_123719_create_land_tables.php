<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLandTables extends Migration {

	public function up() {
		Schema::create('land', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('turn')->default(0)->unsigned()->nullable();
			$table->double('area')->default(0)->unsigned()->nullable();
			$table->integer('number')->default(0)->unsigned()->nullable();
			$table->tinyInteger('status')->default(0)->unsigned()->nullable();
			$table->double('price')->default(0)->unsigned()->nullable();
			$table->string('coordinates', 30)->nullable();

			$table->text('description')->nullable();
			$table->integer('photo_id')->unsigned()->nullable();
			$table->integer('gallery_id')->unsigned()->nullable();
			$table->boolean('sold')->default(0)->unsigned()->nullable();
			$table->timestamps();
		});
	}

	public function down() {
		Schema::drop('land');
	}

}
