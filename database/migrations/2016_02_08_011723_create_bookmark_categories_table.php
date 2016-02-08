<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookmarkCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmark_categories', function (Blueprint $table) {
            $table->integer('bookmark_id')->unsigned();
            $table->foreign('bookmark_id')->references('id')->on('bookmarks');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bookmark_categories');
    }
}
