<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('actor_movie')) {
            Schema::create('actor_movie', function (Blueprint $table) {
                $table->increments('id');
                $table->uuid('actor_id');
                $table->uuid('movie_id');
            });
        }

        if (!Schema::hasTable('actors')) {
            Schema::create('actors', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('movies')) {
            Schema::create('movies', function (Blueprint $table) {
                $table->uuid('id')->primary();

                $table->string('title');
                $table->integer('year', false, true);

                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
        Schema::dropIfExists('actors');
        Schema::dropIfExists('actor_movie');
    }
}
