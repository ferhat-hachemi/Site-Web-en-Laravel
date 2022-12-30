<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Seance;
use App\Models\User;
use App\Models\Cour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoursController extends Controller
{
    //fonction qui affiche la liste des cours
    public function listeCours(){

        $cour =DB::table('cours')->get();
        return view('cours.liste_cours',['cours'=>$cour]);

    }
    //fonction qui renvoie le formulaire qui permet de creer un cours
    public function creercoursForm(){

        return view('cours.creer_cours');
    }
    //fonction qui permet de creer un cours
    public function creerCours(Request $request){

        $r =$request->validate([
            'intitule'=>'required|string',

        ]);
        $cour = new Cour();
        $cour ->intitule =  $r['intitule'];
        $cour ->save();

        $request->session()->flash('etat','Le cour a ete cree avec succes !');

        return redirect('/listecours');
    }
    //fonction qui renvoie le formulaire qui permet de modifier un cours
    public function modifierCoursForm($id){

        $cour = Cour::findOrFail($id);
        return view('cours.modifier_cours',['cours'=>$cour]);
    }
    //fonction qui permet de modifier un cours
    public function modifierCours(Request $request,$id){

        $cour = Cour::findOrFail($id);
        if($request->has('Modifier')){
            $r=$request->validate([
                'intitule'=>'required|string',

            ]);

            $cour ->intitule =$r['intitule'];

            $cour ->save();

            $request ->session()->flash('etat','Le cours a ete modifie avec succes !');
        }else{
            $request ->session()->flash('etat','La modification a ete annulee !');
        }
        return redirect('/listecours');
    }
    //fonction qui renvoie le formulaire qui permet de supprimer un cours
    public function supprimerCoursForm($id){


        $cour =Cour::findOrfail($id);
        return view('cours.supprimer_cours',['cours'=>$cour]);
    }
    //fonction qui permet de supprimer un cours
    public function supprimerCours($id){

        $cour =Cour::findOrFail($id);

        DB::delete('delete from cours_etudiants where cours_id=?',[$cour->id]);

        DB::delete('delete from cours_users where cours_id=?',[$cour->id]);

        $seances=$cour->seances;

        foreach ($seances as $seance){

            DB::delete('delete from presences where seance_id=?', [$seance->id]);

            $seance->delete();
        }

        $cour->delete();

        return redirect('/listecours')->with('etat','Le cours a ete supprime avec succes !');


        //DB::delete('delete from presences where seance_id =?',[$seance->id]);




    }
    //fonction qui permet de chercher un cours dans la liste
    public function rechercherCours(Request $request)
    {

        $recherche = $request->get('search');

        $cour = Cour::where('intitule', 'like', "{$recherche}")->get();

        return view('cours.liste_cours', ['cours' => $cour]);


        }

        //fonction qui permet d'afficher les cours auquel un enseignant est associe
        public function listCoursEnseignant($id)
        {
            if (Auth::user()->Enseignant()) {
                $user = Auth::user();
                $id = $user->id;
            }

            $user = User::findOrFail($id);

            return view('cours.liste_cours_associe', compact('user'));


        }


}
