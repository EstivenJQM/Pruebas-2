<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;
    protected $fillable = [
        'documento','primer_nombre','segundo_nombre',
        'primer_apellido','segundo_apellido','correo'
    ];

    public function roles() {
        return $this->hasMany(RolUsuario::class, 'id_usuario', 'id_usuario');
    }

    public function getNombreCompletoAttribute(): string {
        return trim("{$this->primer_nombre} {$this->segundo_nombre} "
                  . "{$this->primer_apellido} {$this->segundo_apellido}");
    }
}