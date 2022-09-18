<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('values', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('record_id')->constrained();
            $table->string('key');
            $table->string('type');
            $table->string('value');
            $table->unique(['record_id', 'key']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('values');
    }
};
