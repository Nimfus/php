<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('threads', function (Blueprint $table) {
            $table->dropForeign('threads_first_user_foreign');
            $table->dropForeign('threads_second_user_foreign');

            $table->dropColumn('first_user');
            $table->dropColumn('second_user');
        });

        Schema::create('threads_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('thread_id')->unsigned();

            $table->foreign('user_id')
                ->references('id')->on('users');

            $table->foreign('thread_id')
                ->references('id')->on('threads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
