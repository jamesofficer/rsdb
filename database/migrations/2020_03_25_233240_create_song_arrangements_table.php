<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongArrangementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_arrangements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('song_id');
            $table->unsignedBigInteger('arrangement_id');
            $table->unsignedBigInteger('tuning_id');
            $table->boolean('capo_required')->default(0);
            $table->decimal('difficulty', 10, 9)->nullable();
            $table->timestamps();

            $table->foreign('song_id')->references('id')->on('songs');
            $table->foreign('arrangement_id')->references('id')->on('arrangements');
            $table->foreign('tuning_id')->references('id')->on('tunings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song_arrangements');
    }
}
