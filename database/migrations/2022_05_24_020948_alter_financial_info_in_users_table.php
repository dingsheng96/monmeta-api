<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFinancialInfoInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->renameColumn('total_purchase', 'usdt_total_purchase');
            $table->renameColumn('total_prize_claim', 'usdt_total_prize_claim');
            $table->renameColumn('balance', 'usdt_balance');

            $table->dropColumn('currency');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->double('mspc_balance', 36, 18)->default(0)->after('usdt_balance');
            $table->double('mspc_total_prize_claim', 36, 18)->unsigned()->default(0)->after('usdt_balance');
            $table->double('mspc_total_purchase', 36, 18)->unsigned()->default(0)->after('usdt_balance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->renameColumn('usdt_total_purchase', 'total_purchase');
            $table->renameColumn('usdt_total_prize_claim', 'total_prize_claim');
            $table->renameColumn('usdt_balance', 'balance');

            $table->string('currency')->after('decimals');

            $table->dropColumn('mspc_balance');
            $table->dropColumn('mspc_total_prize_claim');
            $table->dropColumn('mspc_total_purchase');
        });
    }
}
