<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    protected $table ='users';

    protected $hidden = ['mdp'];

    protected $fillable =['login','mdp','type'];

    protected $attributes = ['type'=>null];

    public function getAuthPassword()
    {
        return $this->mdp;
    }
    public function isAdmin(){
        return $this->type == 'admin';
    }
    public function Enseignant(){
        return $this->type == 'enseignant';
    }
    public function Gestionnaire(){
        return $this->type == 'gestionnaire';
    }
    function cours()
    {
        return $this->belongsToMany(Cour::class,'cours_users','user_id','cours_id');
    }
}
