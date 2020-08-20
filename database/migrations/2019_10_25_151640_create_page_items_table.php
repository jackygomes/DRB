<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->string('particular');
            $table->string('excel_file_url');
            $table->string('pdf_file_url');
            $table->integer('excel_file_url_download_count');
            $table->integer('pdf_file_url_download_count');
            $table->bigInteger('page_id');
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
        Schema::dropIfExists('page_items');
    }
}
