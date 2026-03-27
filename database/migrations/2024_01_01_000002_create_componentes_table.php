<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('componente', function (Blueprint $table) {
            $table->smallIncrements('id_componente');
            $table->string('nombre', 120);
            $table->unsignedSmallInteger('id_area');
            $table->foreign('id_area')->references('id_area')->on('area')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }
    public function down(): void { Schema::dropIfExists('componente'); }
};