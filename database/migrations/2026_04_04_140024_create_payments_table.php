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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->enum('payment_method', ['razorpay', 'cod', 'upi']);
            $table->enum('payment_status', ['pending', 'processing', 'completed', 'failed', 'refunded']);
            $table->decimal('amount', 10, 2);
            $table->string('transaction_id', 255)->nullable();
            $table->string('razorpay_order_id', 255)->nullable();
            $table->string('razorpay_payment_id', 255)->nullable();
            $table->string('razorpay_signature', 255)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->string('refund_id', 255)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['booking_id', 'payment_status']);
            $table->index('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
