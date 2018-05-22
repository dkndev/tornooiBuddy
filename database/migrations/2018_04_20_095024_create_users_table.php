<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birthday')->nullable();
            $table->char('gender',1)->nullable();
            $table->integer('postcode_id')->unsigned()->nullable();
            $table->integer('rank_single')->unsigned()->nullable();
            $table->integer('rank_dubbles')->unsigned()->nullable();
            $table->integer('rank_mix')->unsigned()->nullable();
            $table->integer('complete')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('postcode_id')->references('id')->on('postcodes');
            $table->foreign('rank_single')->references('id')->on('rankings');
            $table->foreign('rank_dubbles')->references('id')->on('rankings');
            $table->foreign('rank_mix')->references('id')->on('rankings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
