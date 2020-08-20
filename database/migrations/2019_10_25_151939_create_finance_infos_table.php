<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->bigInteger('company_id');
            $table->integer('year');
            $table->string('annual_excel_url');
            $table->string('annual_pdf_1_url');
            $table->string('annual_pdf_2_url');
            $table->string('annual_pdf_3_url');
            $table->string('annual_pdf_4_url');
            $table->string('annual_pdf_5_url');
            $table->string('q1__pdf_url');
            $table->string('q1_excel_url');
            $table->string('q2__pdf_url');
            $table->string('q2_excel_url');
            $table->string('q3__pdf_url');
            $table->string('q3_excel_url');
            $table->string('q4__pdf_url');
            $table->string('q4_excel_url');
            $table->string('annual_excel_download_count');
            $table->string('annual_pdf_1_download_count');
            $table->string('annual_pdf_2_download_count');
            $table->string('annual_pdf_3_download_count');
            $table->string('annual_pdf_4_download_count');
            $table->string('annual_pdf_5_download_count');
            $table->string('q1__pdf_download_count');
            $table->string('q1_excel_download_count');
            $table->string('q2__pdf_download_count');
            $table->string('q2_excel_download_count');
            $table->string('q3__pdf_download_count');
            $table->string('q3_excel_download_count');
            $table->string('q4__pdf_download_count');
            $table->string('q4_excel_download_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finance_infos');
    }
}
