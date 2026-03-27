<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('programa', function (Blueprint $table) {
            $table->smallIncrements('id_programa');
            $table->string('nombre', 150);
            $table->unsignedSmallInteger('id_facultad');
            $table->enum('nivel_academico', ['PREGRADO', 'POSTGRADO']);
            $table->enum('tipo_formacion', ['TECNICA','TECNOLOGICA','PROFESIONAL',
                                            'ESPECIALIZACION','MAESTRIA','DOCTORADO']);
            $table->foreign('id_facultad')->references('id_facultad')->on('facultad')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }
    public function down(): void { Schema::dropIfExists('programa'); }
};