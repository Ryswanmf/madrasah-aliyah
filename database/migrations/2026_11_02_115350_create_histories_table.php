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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default('milestone'); // milestone, tokoh, narasi
            $table->string('period')->nullable(); // e.g., '01', 'Fase Perintisan', '2010 - 2015'
            $table->string('badge')->nullable(); // e.g., 'Fondasi Dakwah', 'Pengasuh Pesantren'
            $table->string('image')->nullable();
            $table->text('description');
            $table->string('quote')->nullable(); // Kutipan / amanat / motto
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
