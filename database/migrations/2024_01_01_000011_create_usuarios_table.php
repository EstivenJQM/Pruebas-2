<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->string('documento', 20)->unique();
            $table->string('primer_nombre', 80);
            $table->string('segundo_nombre', 80)->nullable();
            $table->string('primer_apellido', 80);
            $table->string('segundo_apellido', 80)->nullable();
            $table->string('correo', 150)->unique();
        });
    }
    public function down(): void { Schema::dropIfExists('usuario'); }
};