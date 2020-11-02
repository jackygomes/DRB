<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tutorial_category_id');
            $table->string('name');
            $table->string('tutorial_image');
            $table->string('date');
            $table->string('trainers');
            $table->text('description');
            $table->text('attendees');
            $table->text('curriculum');
            $table->text('requirement');
            $table->decimal('price');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('tutorials');
    }
}
