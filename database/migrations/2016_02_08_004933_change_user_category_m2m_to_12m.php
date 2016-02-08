<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUserCategoryM2mTo12m extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('user_categories');
        Schema::dropIfExists('categories');
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->text('description');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('categories', function ($table) {
            $table->dropForeign('categories_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::create('user_categories', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }
}
