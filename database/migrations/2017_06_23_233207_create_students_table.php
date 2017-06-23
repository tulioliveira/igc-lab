<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->string('cpf')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('course');
            $table->string('zipcode');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->integer('number');
            $table->string('complement');
            $table->string('phone');
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
        Schema::dropIfExists('students');
    }
}
