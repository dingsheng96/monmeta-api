<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nft_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('game_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('room_id')->index();
            $table->string('game_season_id')->index();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->unsignedBigInteger('duration')
                ->nullable()
                ->default(0)
                ->comment('in seconds');
            $table->unsignedBigInteger('position')->default(1);
            $table->bigInteger('points')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_histories');
    }
}
