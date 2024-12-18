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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->foreignId('docente_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('salon');
            $table->integer('capacidad');
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion');
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
            $table->foreignId('periodo_academico_id')->constrained('periodo_academicos')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
