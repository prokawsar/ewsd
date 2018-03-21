<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idea');
            $table->boolean('approve')->default(0);
            $table->boolean('anonym')->default(0);
            $table->integer('cat_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('depart_id')->unsigned();

            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('cat_id')->references('id')->on('categories');
            $table->foreign('depart_id')->references('id')->on('departments');

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
        Schema::dropIfExists('ideas');
    }
}
