<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('hash_id')->index();
            $table->morphs('sourceable');
            $table->string('type')->index();
            $table->string('status')->index();
            $table->unsignedBigInteger('amount')->default(0);
            $table->unsignedInteger('decimals')->default(18);
            $table->longText('description')->nullable();
            $table->timestamp('transaction_date')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
