<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('ticker_id')->nullable();
            $table->integer('sector_id')->nullable();
            $table->string('provider')->nullable();
            $table->integer('category_id')->nullable();
            $table->timestamp('date')->nullable();
            $table->text('analysts')->nullable();
            $table->text('description')->nullable();
            $table->text('report_excel')->nullable();
            $table->text('report_pdf')->nullable();
            $table->decimal('price', 10, 2)->default(0)->nullable();
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('products');
    }
}
