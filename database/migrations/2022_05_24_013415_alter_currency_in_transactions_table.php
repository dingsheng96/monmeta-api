<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCurrencyInTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {

            $table->double('mspc', 36, 18)
                ->default(0)
                ->unsigned()
                ->after('amount');

            $table->renameColumn('amount', 'usdt');
            $table->dropColumn('currency');
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
            $table->string('currency')->after('status');
            $table->renameColumn('usdt', 'amount');
            $table->dropColumn('mspc');
        });
    }
}
