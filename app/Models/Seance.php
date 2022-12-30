<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table ='seances';

    protected $primaryKey = 'id';

    protected $fillable =['cours_id','date_debut','date_fin'];

    function etudiants(){
        return $this->belongsToMany(Etudiant::class,'presences','seance_id','etudiant_id');
    }
    function cours(){
        return $this->belongsTo(Cour::class,'cours_id');
    }
}
