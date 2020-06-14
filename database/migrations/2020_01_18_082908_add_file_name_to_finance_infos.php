<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileNameToFinanceInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finance_infos', function (Blueprint $table) {
            $table->string('annual_excel_url_file_name')->nullable();
            $table->string('annual_pdf_1_url_file_name')->nullable();
            $table->string('annual_pdf_2_url_file_name')->nullable();
            $table->string('annual_pdf_3_url_file_name')->nullable();
            $table->string('annual_pdf_4_url_file_name')->nullable();
            $table->string('annual_pdf_5_url_file_name')->nullable();
            $table->string('q1__pdf_url_file_name')->nullable();
            $table->string('q1_excel_url_file_name')->nullable();
            $table->string('q2__pdf_url_file_name')->nullable();
            $table->string('q2_excel_url_file_name')->nullable();
            $table->string('q3__pdf_url_file_name')->nullable();
            $table->string('q3_excel_url_file_name')->nullable();
            $table->string('q4__pdf_url_file_name')->nullable();
            $table->string('q4_excel_url_file_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('finance_infos', function (Blueprint $table) {
            $table->dropColumn('annual_excel_url_file_name');
            $table->dropColumn('annual_pdf_1_url_file_name');
            $table->dropColumn('annual_pdf_2_url_file_name');
            $table->dropColumn('annual_pdf_3_url_file_name');
            $table->dropColumn('annual_pdf_4_url_file_name');
            $table->dropColumn('annual_pdf_5_url_file_name');
            $table->dropColumn('q1__pdf_url_file_name');
            $table->dropColumn('q1_excel_url_file_name');
            $table->dropColumn('q2__pdf_url_file_name');
            $table->dropColumn('q2_excel_url_file_name');
            $table->dropColumn('q3__pdf_url_file_name');
            $table->dropColumn('q3_excel_url_file_name');
            $table->dropColumn('q4__pdf_url_file_name');
            $table->dropColumn('q4_excel_url_file_name');
        });
    }
}
