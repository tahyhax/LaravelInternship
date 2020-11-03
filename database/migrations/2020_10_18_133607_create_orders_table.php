<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 20)->unique();
            $table->string('address', 255);
            $table->string('email', 255);
            $table->string('phone', 50);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('payment_methods_id')->constrained('payment_methods');
            $table->enum('status', ['approved','canceled','closed','new'])->default('new');
            $table->timestamps();
            $table->index(['status', 'slug', 'address']);
        });
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
