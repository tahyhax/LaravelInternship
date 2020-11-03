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
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('payment_methods_id')->constrained('payment_methods');
            $table->enum('status', ['approved','canceled','closed','new'])->default('new');
            $table->timestamps();
            $table->index(['status', 'slug', 'address']);
        });
        
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => \Database\Seeders\PaymentMethodSeeder::class
        ]);
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
