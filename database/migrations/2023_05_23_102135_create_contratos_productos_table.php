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
        Schema::create('contratos_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrato_id')->references('id')->on('contratos');
            $table->foreignId('producto_id')->references('id')->on('productos');
            $table->enum('tipo',['Fijo','Linea'])->nullable();
            $table->enum('clase',['Nueva','Portavilidad'])->nullable();
            $table->string('numero')->nullable();
            $table->string('nombre_titular')->nullable();
            $table->string('dni')->nullable();
            $table->string('comercializadora_actual')->nullable();
            $table->string('operador_donante')->nullable();
            $table->string('icc')->nullable();
            $table->boolean('linea_principal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos_productos');
    }
};
