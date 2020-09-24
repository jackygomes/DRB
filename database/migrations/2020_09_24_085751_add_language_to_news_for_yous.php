<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLanguageToNewsForYous extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_for_yous', function (Blueprint $table) {
            $table->string('newspaper_id')->change()->nullable();
            $table->string('category_id')->change()->nullable();
            $table->string('language')->after('newspaper_id')->nullable();
            $table->renameColumn('newspaper_id', 'newspapers');
            $table->renameColumn('category_id', 'categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_for_yous', function (Blueprint $table) {
            $table->dropColumn('language');
        });
    }
}
