<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('review_title', 80);
            $table->text('review_description');
            $table->smallInteger('rating')->nullable();
            $table->integer('listing_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index(['listing_id', 'active']);
            $table->index(['user_id', 'active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
