<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('delivery_id')
            ->comment('1: Delivery, 2: Pickup');
            $table->integer('status_id')
            ->comment('1: Received, 2: Confirmed, 3: Preparing, 4: Delivering, 5: Delivered, 6: Ready for Pickup, 7: Refunded, 8: Canceled')
            ->default(1);
            $table->decimal('total', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
