<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildingsTables extends Migration {

    public function up() {
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->nullable();
            $table->double('area')->default(0)->unsigned()->nullable();
            $table->double('land_area')->default(0)->unsigned()->nullable();
            $table->string('material', 100)->nullable();
            $table->integer('number')->default(0)->unsigned()->nullable();
            $table->string('communication', 200)->nullable();
            $table->double('price')->default(0)->unsigned()->nullable();
            $table->integer('land_id')->default(0)->unsigned()->nullable();

            $table->text('description')->nullable();
            $table->integer('photo_id')->unsigned()->nullable();
            $table->integer('gallery_id')->unsigned()->nullable();
            $table->boolean('sold')->default(0)->unsigned()->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('buildings');
    }

}
