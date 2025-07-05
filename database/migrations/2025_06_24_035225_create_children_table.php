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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('traveller_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('relationship')->nullable(); // e.g., 'Son' or 'Daughter'
            $table->date('passport_issued')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
