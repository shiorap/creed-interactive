<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('genre_podcast');

        Schema::create('genre_podcasts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('podcast_id');
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->foreign('podcast_id')->references('id')->on('podcasts');
            $table->unique(['genre_id', 'podcast_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genre_podcast');
    }
};
