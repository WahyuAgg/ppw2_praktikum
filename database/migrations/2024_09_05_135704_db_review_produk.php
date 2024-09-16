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
        {
            // Tabel Produk
            Schema::create('produk', function (Blueprint $table) {
                $table->id('produk_id');
                $table->string('name', 150);
                $table->text('description')->nullable();
                $table->decimal('price', 10, 2);
                $table->integer('stock');
                $table->string('category', 50)->nullable();
                $table->timestamps();
            });

        }
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop tables if rollback happens
        Schema::dropIfExists('review');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('user');
    }
};
