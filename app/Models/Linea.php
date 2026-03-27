<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model {
    protected $table = 'linea';
    protected $primaryKey = 'id_linea';
    public $timestamps = false;
    protected $fillable = ['nombre', 'id_componente'];

    public function componente() {
        return $this->belongsTo(Componente::class, 'id_componente', 'id_componente');
    }
    public function tiposActividad() {
        return $this->belongsToMany(TipoActividad::class, 'linea_tipo_actividad',
                                    'id_linea', 'id_tipo_actividad');
    }
}