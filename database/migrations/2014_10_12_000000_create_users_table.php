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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('city');
            $table->string('province');
            $table->string('dni');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('payment_method');
            $table->string('iban');
            $table->string('contact_name');
            $table->string('cp');
            $table->enum('role', ['Administrador', 'Agente','Subagente']);
            $table->string('contact_number');
            $table->integer('irpf');
            $table->text('objectives');
            $table->foreignId('agente_id')->nullable()->references('id')->on('users');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
