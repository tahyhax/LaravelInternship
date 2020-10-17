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
            $table->string('name',75)->unique();
            $table->string('slug',75)->unique();
            $table->string('sku',10)->unique();
            $table->mediumText('description')->nullable();
            $table->decimal('price',8, 2);
            $table->smallInteger('in_stock');
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
