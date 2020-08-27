<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionIdAndCheckImageToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->after('price');
            $table->string('check_image')->nullable()->after('transaction_id');
            $table->boolean('isApproved')->default(1)->after('user_limit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('transaction_id');
            $table->dropColumn('check_image');
            $table->dropColumn('isApproved');
        });
    }
}
