<?php

namespace App\Http\Controllers;

use App\Models\User ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    //fonction qui affiche la liste des utilisateurs de type null en attente de validation
    public function listeUtilisateursattente(){

        $user = User::where('type','=',null)->get();

        return view('admin.liste_user_valider', ['users' => $user]);
    }
    //fonction qui renvoie le formulaire qui permet d'accepter un utilisateur et mettre a jour son type
    public function accepterForm($id){

        $user = User::findOrFail($id);
        return view('admin.accepter_user', ['users' => $user]);
    }
    //fonction qui permet d'accepter un utilisateur et mettre a jour son type
    public function accepterUtilisateurs(Request $request, $id){

        $user = User::findOrFail($id);

        $r = $request->validate(
            [
                'type' => 'required'
            ]
        );
        $user->type = $r['type'];

        $user->save();

        return redirect()->route('listetousutilisateurs')->with('etat', 'L`utilisateur a ete accepte !');
    }
    /*public function filtrer(Request $request){
        if($request->has('integral')){

            $user = User::where('type','!=',null)->get();

            return view('admin.liste_user',['users'=>$user]);

        }elseif($request->has('enseignant')){

            $user = User::where('type','=', 'enseignant')->get();

            return view('admin.liste_user', ['users' => $user]);
        }else{

            $user = User::where('type','=', 'gestionnaire')->get();

            return view('admin.liste_user', ['users' => $user]);
        }
    }*/
    //fonction qui affiche la liste des admin
    public function listeAdmin(){

        $user = User::where('type','=','admin')->get();
        return view('admin.liste_user',['users'=>$user]);
    }

    //fonction qui affiche la liste de tous les utilisateurs
    public function listetousUtilisateurs(){

        $user = User::where('type','!=',null)->get();
        return view('admin.liste_user',['users'=>$user]);
    }
    //fonction qui affiche la liste des enseignants
    public function filtrerUtilisateursEnseignant()
    {
        $user = User::where('type','=', 'enseignant')->get();

        return view('admin.liste_user', ['users' => $user]);
    }
    //fonction qui affiche la liste des gestionnaires
    public function filtrerUtilisateursGestionnaire()
    {
        $user = User::where('type','=', 'gestionnaire')->get();

        return view('admin.liste_user', ['users' => $user]);
    }
    //fonction qui renvoie le formulaire qui permet de refuser un nouveau utilisateur /supprimer un utilisateur
    public function refuserForm($id){

        $user = User::findOrFail($id);

        return view('admin.refuser_user', ['users' => $user]);
    }
    //fonction qui permet de refuser un nouveau utilisateur /supprimer un utilisateur
    public function refuserUtilisateurs($id)
    {
        $user = User::findOrFail($id);

        DB::delete('delete from cours_users where user_id=?',[$user->id]);

        $user->delete();

        return redirect()->route('listetousutilisateurs')->with('etat', 'L`utilisateur a ete supprime !');

    }
    //focntion qui renvoie le formulaire qui permet de creer un nouveau utilisateur
    public function creerutilisateursForm(){

        return view('admin.creer_user');
    }
    //focntion qui permet de creer un nouveau utilisateur
    public function creerUtilisateurs(Request $request){
        $request->validate(
            [
                'nom'=>'required|string',
                'prenom'=>'required|string',
                'login'=>'required|string|unique:users',
                'mdp'=>'required|confirmed',
                'type'=>'required'
            ]
        );
        $user = new User();
        $user ->nom = $request->nom;
        $user ->prenom = $request->prenom;
        $user ->login = $request->login;
        $user ->mdp = Hash::make($request->mdp);
        $user ->type=$request->type;

        $user ->save();

        $request->session()->flash('etat','L`utilisateur a ete cree avec succes');



        return redirect('/');

    }
    //fonction qui permet de chercher un utilisateur dans la liste
    public function rechercherUtilisateurs(Request $request){
        $recherche =$request->get('search');

        $user = User::where('nom','like',"{$recherche}")->orWhere('prenom','like',"{$recherche}")
          ->orWhere('login','like',"{$recherche}")->get();

        return view('admin.liste_user',['users'=>$user]);

    }
    //fonction qui renvoie le formulaire qui permet de modifier un utilisateur
    public function modifierUtilisateursForm($id){

        $user = User::findOrFail($id);
        return view('admin.modifier_user',['users'=>$user]);
    }
    //fonction qui permet de modifier un utilisateur
    public function modifierUtilisateurs(Request $request,$id){
        $user = User::findOrFail($id);
        if($request->has('Modifier')){
            $r = $request->validate(
                [
                    'nom'=>'required|string',
                    'prenom'=>'required|string',
                    'mdp'=>'required|confirmed',
                    'type' => 'required'
                ]
            );

            $user->nom = $r['nom'];
            $user->prenom = $r['prenom'];
            $user->mdp = Hash::make($request->mdp);
            $user->type = $r['type'];
            if($user->type=='gestionnaire' || $user->type=='admin' ){
                DB::delete('delete from cours_users where user_id=?',[$user->id]);
            }

            $user->save();

            $request->session()->flash('etat','L`utilisateur a ete modifie avec succes !');
        }else{
            $request->session()->flash('etat','La modification a ete annulee !');

        }
        return redirect('/listeuser');
    }

}
