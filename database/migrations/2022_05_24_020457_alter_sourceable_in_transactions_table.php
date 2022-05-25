<?php

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSourceableInTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {

            $table->dropColumn('sourceable_type');

            $table->foreignId('user_id')
                ->nullable()
                ->after('hash_id')
                ->constrained();
        });

        Transaction::get()
            ->each(function ($transaction) {
                $transaction->user_id = $transaction->sourceable_id;
                $transaction->save();
            });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('sourceable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {

            $table->morphs('sourceable');
        });

        Transaction::get()
            ->each(function ($transaction) {
                $transaction->sourceable_type = User::class;
                $transaction->sourceable_id = $transaction->user_id;
                $transaction->save();
            });
    }
}
