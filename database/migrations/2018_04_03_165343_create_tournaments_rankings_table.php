<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments_rankings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tournament_id')->unsigned()->nullable();
            $table->integer('ranking_id')->unsigned()->nullable();
        });

        Schema::table('tournaments_rankings', function (Blueprint $table) {
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->foreign('ranking_id')->references('id')->on('rankings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournaments_rankings');
    }
}
