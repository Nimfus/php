<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('liked_by')->unsigned();

            $table->foreign('user_id')
                ->references('id')->on('users');

            $table->foreign('liked_by')
                ->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_likes', function(Blueprint $table) {
            $table->dropForeign('users_likes_user_id_foreign');
            $table->dropForeign('users_likes_liked_by_foreign');
        });

        Schema::drop('users_likes');
    }
}
