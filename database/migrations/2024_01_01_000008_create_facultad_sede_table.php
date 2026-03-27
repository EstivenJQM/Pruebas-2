<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('facultad_sede', function (Blueprint $table) {
            $table->unsignedSmallInteger('id_facultad');
            $table->unsignedSmallInteger('id_sede');
            $table->primary(['id_facultad', 'id_sede']);
            $table->foreign('id_facultad')->references('id_facultad')->on('facultad')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_sede')->references('id_sede')->on('sede')
                  ->onUpdate('cascade')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('facultad_sede'); }
};