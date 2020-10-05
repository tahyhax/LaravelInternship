<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku',100)->unique();
            $table->string('name',200)->unique();
            $table->string('slug',200)->unique();
            $table->mediumText('description')->nullable();
            $table->string('cover')->nullable();
            $table->decimal('price',8, 2);
            $table->timestamps();
            $table->index(['slug','sku']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
