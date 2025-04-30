<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();

            // Student Details
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('surname');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('admission_type');
            $table->json('batch'); // Store as JSON array ['morning', 'noon']

            // Parents Details
            $table->string('father_name');
            $table->string('father_phone');
            $table->string('father_occupation')->nullable();
            $table->string('mother_name');
            $table->string('mother_phone')->nullable();
            $table->string('mother_occupation')->nullable();

            // Address
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('pin_code');

            // Referral Source
            $table->json('referral_source'); // Store as JSON array ['newspaper', 'social_media', etc.]

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
