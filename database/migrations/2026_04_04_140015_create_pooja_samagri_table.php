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
        Schema::create('pooja_samagri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pooja_id')->constrained()->onDelete('cascade');
            $table->foreignId('samagri_id')->constrained('samagri_items')->onDelete('cascade');
            $table->decimal('quantity', 10, 2);
            $table->boolean('is_required')->default(true);
            $table->timestamps();
            
            $table->unique(['pooja_id', 'samagri_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pooja_samagri');
    }
};
