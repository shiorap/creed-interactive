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
        Schema::create('podcasts', function (Blueprint $table) {
            $table->string('id',255)->nullable(false)->primary();
            $table->string('title', '255')->index();
            $table->string('publisher', 255)->index();
            $table->text('image')->nullable();
            $table->text('thumbnail')->nullable();
            $table->string('listennotes_url', 255)->nullable()->unique();
            $table->unsignedSmallInteger('total_episodes');
            $table->text('description')->nullable();
            $table->integer('itunes_id')->nullable()->index();
            $table->text('rss')->nullable();
            $table->string('language',255);
            $table->string('country', 255);
            $table->text('website')->nullable();
            $table->boolean('is_claimed')->default(false);
            $table->string('type', 255);
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
        Schema::dropIfExists('podcasts');
    }
};
