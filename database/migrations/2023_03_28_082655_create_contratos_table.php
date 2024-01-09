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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->references('id')->on('clientes');
            $table->date('fecha_incio');
            $table->date('fecha_fin');
            $table->enum('tipo_contrato',['Luz','Gas','Telefonia']);
            $table->foreignId('comercializadora_id')->references('id')->on('comercializadoras');
            $table->foreignId('producto_id')->references('id')->on('productos');
            $table->string('cups')->nullable();
            $table->string('direccion');
            $table->string('cp');
            $table->enum('estado',['Por revisar','Revisado','Pte. firma','Pte. verificación','Tramitado',
                'Activo','Incidencia','Rechazado','A renovar','Inactivo']);
            $table->string('poblacion');
            $table->string('provincia');
            $table->string('titular_banco');
            $table->string('iban');
            $table->string('movil')->nullable();
            $table->string('email')->nullable();
            $table->text('comentarios')->nullable();
            $table->json('documentos')->nullable();
            $table->string('documento_dni')->nullable();
            $table->string('documento_factura')->nullable();
            $table->string('documento_escritura')->nullable();
            $table->string('documento_cif')->nullable();
            $table->string('documento_cie')->nullable();
            $table->enum('factura_online',['Si','No']);
            $table->float('precio_producto');
            $table->float('iva');
            $table->float('comision')->default(0);
            $table->integer('liquidacion')->default(0);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
