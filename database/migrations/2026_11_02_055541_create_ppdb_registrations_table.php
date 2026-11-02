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
        Schema::create('ppdb_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number', 32)->unique();
            $table->string('full_name');
            $table->string('nisn', 20)->nullable();
            $table->enum('gender', ['L', 'P'])->default('L');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('school_origin');
            $table->string('parent_name');
            $table->string('phone_number', 25);
            $table->text('address');
            $table->string('program_choice', 50)->default('Peminatan IPA / Keagamaan');
            $table->boolean('dormitory_choice')->default(true); // Mukim di Pesantren / Non-Mukim
            $table->enum('status', ['pending', 'verified', 'accepted', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_registrations');
    }
};
