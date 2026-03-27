<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model {
    protected $table = 'componente';
    protected $primaryKey = 'id_componente';
    public $timestamps = false;
    protected $fillable = ['nombre', 'id_area'];

    public function area() {
        return $this->belongsTo(Area::class, 'id_area', 'id_area');
    }
    public function lineas() {
        return $this->hasMany(Linea::class, 'id_componente', 'id_componente');
    }
}