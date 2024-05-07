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
        Schema::create('collection_user', function (Blueprint $table) {
            $table->foreignId('collection_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->unique(['collection_id', 'user_id'], 'foreing_keys');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_user');
    }
};
