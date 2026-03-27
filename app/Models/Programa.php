<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model {
    protected $table = 'programa';
    protected $primaryKey = 'id_programa';
    public $timestamps = false;
    protected $fillable = ['nombre', 'id_facultad', 'nivel_academico', 'tipo_formacion'];

    public function facultad() {
        return $this->belongsTo(Facultad::class, 'id_facultad', 'id_facultad');
    }
    public function sedes() {
        return $this->hasMany(ProgramaSede::class, 'id_programa', 'id_programa');
    }
}