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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Pedido al que pertenece
            $table->unsignedBigInteger('platillo_id')->constrained('platillos')->onDelete('cascade'); // Platillo agregado
            $table->integer('quantity'); // Cantidad del platillo
            $table->decimal('price', 8, 2); // Precio en el momento del pedido
            $table->timestamps();
    
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('platillo_id')->references('id')->on('platillos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
