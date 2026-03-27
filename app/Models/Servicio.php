<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model {
    protected $table = 'servicio';
    protected $primaryKey = 'id_servicio';
    public $timestamps = false;
    protected $fillable = ['nombre', 'id_linea', 'id_tipo_actividad', 'id_sede', 'fecha'];

    public function linea() {
        return $this->belongsTo(Linea::class, 'id_linea', 'id_linea');
    }
    public function tipoActividad() {
        return $this->belongsTo(TipoActividad::class, 'id_tipo_actividad', 'id_tipo_actividad');
    }
    public function sede() {
        return $this->belongsTo(Sede::class, 'id_sede', 'id_sede');
    }
    public function participantes() {
        return $this->belongsToMany(RolUsuario::class, 'servicio_usuario',
                                    'id_servicio', 'id_rol_usuario');
    }
}