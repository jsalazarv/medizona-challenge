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
        Schema::create('note_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('note_id')
                ->constrained('notes')
                ->onDelete('cascade');
            $table->foreignId('item_id')
                ->constrained('items')
                ->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_items');
    }
};
