<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table ='cours';

    protected $primaryKey = 'id';

    protected $fillable =['intitule'];


    function etudiants(){
        return $this->belongsToMany(Etudiant::class,'cours_etudiants','cours_id','etudiant_id');
    }
    function users(){
        return $this->belongsToMany(User::class,'cours_users','cours_id','user_id');
    }
    function seances()
    {
        return $this->hasMany(Seance::class,'cours_id');
    }

}
