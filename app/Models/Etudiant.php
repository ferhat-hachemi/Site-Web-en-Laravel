<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table ='etudiants';

    protected $primaryKey = 'id';

    protected $fillable =['nom','prenom','noet'];

    function cours(){
        return $this->belongsToMany(Cour::class,'cours_etudiants','etudiant_id','cours_id');
    }
    function seances(){
        return $this->belongsToMany(Seance::class,'presences','etudiant_id','seance_id');
    }
}
