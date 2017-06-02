<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->integer('user_id')->unique()->unsigned();
            $table->string('provider_user_id');
            $table->string('gender');
            $table->string('provider');
            $table->string('link');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('social_accounts', function ($table) {
            $table->dropForeign('social_accounts_user_id_foreign');
        });

        Schema::drop('social_accounts');
    }
}
