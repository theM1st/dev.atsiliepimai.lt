<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('censors', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('listing_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('commentable_id')->unsigned()->index();
            $table->string('commentable_type', 60);

            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('censors');
    }
}
