<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthentificationController extends Controller
{
    //fonction qui renvoie le formulaire pour se connecter
    public function loginForm(){

        return view('auth.login');
    }
    //fonction qui permet a l'utilisateur de se connecter a son compte
    public function login(Request $request){
        $request ->validate(
            [
                'login'=>'required|string',
                'mdp'=>'required|string'
            ]
        );
        $credentials = ['login' => $request->input('login'),
            'password' => $request->input('mdp')];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user =auth()->user();

            //on empeche le nouveau utilisateur de se connecter jusqu'a son compte soit valide par l'admin
            if($user->type == null){
                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();
                return redirect()->intended('/')->with('etat','Votre compte est encore de verification !');
            }else{
                $request->session()->regenerate();

                return redirect()->intended('/')->with('etat','Vous etes connecte !');

            }

        }

        return back()->withErrors([
            'login'=>'Votre login ou mot de passe sont incorrect',
        ]);

    }
    //fonction qui permet a l'utilisateur de se deconnecter de son compte
    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $request->session()->flash('etat', 'vous etes deconnecte !');

        return redirect('login');
    }
}
