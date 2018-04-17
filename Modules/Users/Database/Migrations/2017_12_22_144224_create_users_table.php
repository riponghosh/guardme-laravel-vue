<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 25)->nullable();
            $table->string('email',90)->unique();
            $table->string('password',60);
            $table->string('api_token',60);

            $table->date('registered_date');

            $table->integer('referrer_id')->unsigned()->nullable();
            $table->double('fb_id')->unsigned()->nullable();
            $table->double('twit_id')->unsigned()->nullable();

            $table->longText('metadata')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
