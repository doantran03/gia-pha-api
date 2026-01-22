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
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            $table->string('avatar')->nullable();
            
            $table->string('full_name');
            $table->string('other_name')->nullable();

            $table->date('birth_date')->nullable();
            $table->date('death_date')->nullable();

            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            $table->unsignedInteger('order')->nullable();
            $table->unsignedInteger('generation')->nullable();

            $table->string('address')->nullable();
            $table->text('biography')->nullable();

            // Quan hệ phả hệ
            $table->foreignId('fid')->nullable()->constrained('members')->nullOnDelete();
            $table->foreignId('mid')->nullable()->constrained('members')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
