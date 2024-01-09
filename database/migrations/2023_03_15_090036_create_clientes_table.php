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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo',['Empresa','Particular']);
            $table->string('dni_cif');
            $table->string('nombre');
            $table->string('representante')->nullable();
            $table->string('direccion');
            $table->string('cp');
            $table->string('poblacion');
            $table->string('provincia');
            $table->string('movil');
            $table->string('email');
            $table->string('telefono1');
            $table->string('telefono2')->nullable();
            $table->string('iban');
            $table->text('notas')->nullable();
            $table->string('contacto');
            $table->string('tel_contacto');
            $table->text('actividad')->nullable();
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
