<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //fonction qui renvoie le formulaire qui permet de creer un compte
    public function registerForm(){

        return view('auth.register');
    }
    //fonction qui permet de creer un compte
    public function register(Request $request){
        $request->validate(
            [
                'nom'=>'required|string',
                'prenom'=>'required|string',
                'login'=>'required|string|unique:users',
                'mdp'=>'required|confirmed',
            ]
        );
        $user = new User();
        $user ->nom = $request->nom;
        $user ->prenom = $request->prenom;
        $user ->login = $request->login;
        $user ->mdp = Hash::make($request->mdp);
        //on met le type null pour les nouveaux utilisateurs jusqu'a ce que l'admin met a jour le type
        $user ->type=null;
        $user ->save();

        $request->session()->flash('etat','Votre compte a ete cree avec succes et il sera valide par l`admin de site');



        return redirect('/');
    }
}
