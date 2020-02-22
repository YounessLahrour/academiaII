<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Modulo;
class Alumno extends Model
{
    //
    protected $fillable=['nombre', 'apellido', 'mail', 'logo'];

    public function modulos(){
       return $this->belongsToMany('App\Modulo')
       ->withTimestamps()
       ->withPivot('nota');
    }
    public function modulosOut(){
        //esto me devuelve los id de los modulos que tiene $alumno
        $modulos1=$this->modulos()->pluck('modulos.id');
        //esto me devuelve los modulos que le faltan al alumno
        $modulos2=Modulo::whereNotIn('id', $modulos1)->get();
        return $modulos2;
    }

    public static function aprobados(){
        foreach(Alumno::all() as $alumno){
            if($alumno->notaMedia()>=5){
                $idAlumnos[]=$alumno->id;
            }
        }
        return Alumno::whereIn('id', $idAlumnos)->get();
    }

    public function notaMedia(){
        $numModulos=$this->modulos()->wherePivot('nota', '!=', 'null')->count();
        $suma=0;
        if($numModulos>0){
            foreach($this->modulos as $modulo){
                $nota=$modulo->pivot->nota;
                $suma+=$nota;
            }
            return round(($suma/$numModulos), 2);
        }
        return "Sin modulos";
    }

    public function scopeModulo($query, $v){
        if(!isset($v)){
           return $query->whereHas('modulos', function($query){$query->where('modulo_id', 'like', '%'); });
        }
        if($v=='%'){
            return $query->whereHas('modulos', function($query){$query->where('modulo_id', 'like', '%'); });
        }
        //hago el use($v) para poder usar el valor de $v dentro del ambito de la funcion
        return $query->whereHas('modulos', function($query) use($v) {$query->where('modulo_id', 'like', $v); });

    }
}

