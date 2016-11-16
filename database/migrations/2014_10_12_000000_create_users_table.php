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
            $table->string('provider_name', 60)->nullable();
            $table->string('provider_uid')->nullable();
            $table->string('email', 60)->nullable();
            $table->string('username', 60);
            $table->string('password')->nullable();
            $table->string('first_name', 60)->nullable();
            $table->string('last_name', 60)->nullable();
            $table->date('birthday')->nullable();
            $table->string('telephone', 60)->nullable();
            $table->string('address', 60)->nullable();
            $table->string('city', 25)->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('picture')->nullable();
            $table->enum('user_role', ['admin'])->nullable();
            $table->boolean('verified')->default(true);
            $table->string('token')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->unique(['email', 'provider_name', 'provider_uid']);
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
