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
        Schema::create('pandits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('experience_years');
            $table->json('languages_known');
            $table->json('specialization');
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->json('verification_documents')->nullable();
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->integer('total_bookings')->default(0);
            $table->decimal('commission_rate', 5, 2)->default(10.00);
            $table->text('bio')->nullable();
            $table->string('bank_account', 50)->nullable();
            $table->string('ifsc_code', 20)->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            
            $table->index(['verification_status', 'is_available']);
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pandits');
    }
};
