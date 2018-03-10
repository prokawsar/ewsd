<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQamanagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qamanagers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('qamanage_id')->unsigned();
//            $table->primary('student_id');

            $table->foreign('qamanage_id')->references('id')->on('users');

            $table->rememberToken();
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
        Schema::drop('qamanagers');
    }
}
