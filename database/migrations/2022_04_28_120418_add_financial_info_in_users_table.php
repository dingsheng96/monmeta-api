<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinancialInfoInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('currency')->nullable()->after('personal_id_no');
            $table->unsignedInteger('decimals')->default(0)->after('personal_id_no');
            $table->bigInteger('balance')->default(0)->after('personal_id_no');
            $table->unsignedBigInteger('total_prize_claim')->default(0)->after('personal_id_no');
            $table->unsignedBigInteger('total_purchase')->default(0)->after('personal_id_no');
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

            $table->dropColumn('total_purchase');
            $table->dropColumn('total_prize_claim');
            $table->dropColumn('balance');
            $table->dropColumn('decimals');
            $table->dropColumn('currency');
        });
    }
}
