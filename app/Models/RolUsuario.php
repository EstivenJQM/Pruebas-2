<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model {
    protected $table = 'rol_usuario';
    protected $primaryKey = 'id_rol_usuario';
    public $timestamps = false;
    protected $fillable = ['id_usuario', 'id_sede', 'rol'];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
    public function sede() {
        return $this->belongsTo(Sede::class, 'id_sede', 'id_sede');
    }
    public function servicios() {
        return $this->belongsToMany(Servicio::class, 'servicio_usuario',
                                    'id_rol_usuario', 'id_servicio');
    }
}