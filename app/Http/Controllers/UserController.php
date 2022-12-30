<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //fonction qui renvoie le formulaire qui permet a l'utilisateur de modifier son mot de passe
    public function modifiermotdepasseForm(User $user)
    {
        //$user =User::findOrFail($id);

        return view('user.modifier_mdp');
    }
    //fonction qui permet a l'utilisateur de modifier son mot de passe
    public function modifierMotdepasse(Request $request)
    {

        if($request->has('Modifier')){
            $request->validate(
                [

                    'mdp' => 'required|confirmed'
                ]
            );

            Auth::user()->mdp = Hash::make($request->mdp);

            Auth::user()->save();

            return redirect('/')->with('etat', 'Votre mot de passe a ete mis a jour !');
        }else{
            return redirect('/')->with('etat', 'La modification de mot de passe est annulee !');

        }

    }
    //fonction qui renvoie le formulaire qui permet a l'utilisateur de modifier son nom et prenom
    public function modifiercompteForm($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('view',$user);

        return view('user.modifier_compte',['users'=>$user]);
    }
    //fonction qui permet a l'utilisateur de modifier nom et prenom
    public function modifierCompte(Request $request)
    {
        if($request->Has('Modifier')){
            $request->validate(
                [
                    'nom' => 'required|string',
                    'prenom' => 'required|string',

                ]
            );
            Auth::user()->nom = $request->nom;

            Auth::user()->prenom = $request->prenom;

            Auth::user()->save();

            return redirect('/')->with('etat', 'Votre nom et prénom ont ete mis a jour !');

        }else{
            return redirect('/')->with('etat', 'La modification de nom et prenom est annulee !');

        }

    }

}

