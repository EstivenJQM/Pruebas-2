<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('programa_sede', function (Blueprint $table) {
            $table->increments('id_programa_sede');
            $table->unsignedSmallInteger('id_programa');
            $table->unsignedSmallInteger('id_sede');
            $table->string('codigo_snies', 20)->unique();
            $table->unique(['id_programa', 'id_sede']);
            $table->foreign('id_programa')->references('id_programa')->on('programa')
                  ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('id_sede')->references('id_sede')->on('sede')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }
    public function down(): void { Schema::dropIfExists('programa_sede'); }
};