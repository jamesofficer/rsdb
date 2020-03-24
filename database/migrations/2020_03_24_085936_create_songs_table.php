<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 255)->unique();
            $table->string('title', 255);
            $table->date('date_added')->nullable();
            $table->string('year', 4);
            $table->string('steam_url')->nullable();
            $table->unsignedBigInteger('artist_id');
            $table->unsignedBigInteger('pack_id')->nullable();
            $table->timestamps();

            $table->foreign('artist_id')->references('id')->on('artists');
            $table->foreign('pack_id')->references('id')->on('packs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
}
