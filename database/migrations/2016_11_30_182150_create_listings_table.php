<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 80);
            $table->string('slug', 100)->nullable()->unique();
            $table->enum('listing_type', ['product', 'service'])->default('product');
            $table->float('avg_rating', 5, 2)->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned();
            $table->boolean('active')->default(false);
            $table->timestamps();

            $table->index(['category_id', 'active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
}
