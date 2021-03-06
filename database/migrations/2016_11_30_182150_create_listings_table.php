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
            $table->text('description')->nullable();
            $table->string('slug', 100)->nullable()->unique();
            $table->string('picture')->nullable();
            $table->enum('listing_type', ['product', 'service'])->default('product');
            $table->float('avg_rating', 5, 2)->nullable();
            $table->integer('category_id')->unsigned();
            $table->integer('brand_id')->nullable()->unsigned()->index();
            $table->string('brand_value', 80)->nullable();
            $table->string('address', 100)->nullable();
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
