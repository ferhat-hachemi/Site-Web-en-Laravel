<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Cour;
use App\Models\Seance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GestionnaireController extends Controller
{
    //fonction qui renvoie le formulaire qui permet de creer un etudiant
    public function creeretudiantsForm(){
        return view('etudiant.ajouter');
    }
    //fonction qui permet de creer un etudiant
    public function creerEtudiants(Request $request){
        $request->validate([
            'nom'=>'required|string|unique:etudiants',
            'prenom'=>'required|string|unique:etudiants',
            'noet'=>'required|integer|unique:etudiants'
        ]);
        $etudiant = new Etudiant();
        $etudiant ->nom = $request->nom;
        $etudiant ->prenom = $request->prenom;
        $etudiant ->noet = $request->noet;

        $etudiant->save();

        $request->session()->flash('etat','L`etudiant a ete cree avec succes !');

        return redirect('/listetudiants');

    }
    //fonction qui affiche la liste des etudiants
    public function listeEtudiants(){

        $etudiant = Etudiant::simplepaginate(3);
        return view('etudiant.liste',['etudiants'=>$etudiant]);
    }
    //fonction qui renvoie le formulaire qui permet de modifier un etudiant
    public function modifierEtudiantsForm($id){

        $etudiant = Etudiant::findOrFail($id);
        return view ('etudiant.modifier',['etudiants'=>$etudiant]);
    }
    //fonction qui permet de modifier un etudiant
    public function modifierEtudiants(Request $request,$id){

        $etudiant = Etudiant::findOrFail($id);
        if($request->has('Modifier')){
            $request->validate([
                'nom'=>'required|string|unique:etudiants',
                'prenom'=>'required|string|unique:etudiants',

            ]);

            $etudiant->nom =request('nom');
            $etudiant->prenom =request('prenom');
            //$etudiant->noet =request('noet');

            $etudiant->save();

            $request->session()->flash('etat','L`etudiant a ete modifie avec succes !');
        }else{
            $request->session()->flash('etat','La modification a ete annulee !');
        }
        return redirect('/listetudiants');
    }
    //fonction qui renvoie le formulaire qui permet de supprimer un etudiant
    public function supprimerEtudiantsForm($id){

        $etudiant = Etudiant::findOrFail($id);

        return view ('etudiant.supprimer',['etudiants'=>$etudiant]);
    }
    //fonction permet de supprimer un etudiant
    public function supprimerEtudiants($id){

        $etudiant = Etudiant::findOrFail($id);

        //on supprime d'abord l'inscription de l'etudiant dans un cour et la presences dans la seance
        DB::delete('delete from presences where etudiant_id=?',[$etudiant->id]);

        DB::delete('delete from cours_etudiants where etudiant_id=?',[$etudiant->id]);

        $etudiant->delete();

        return redirect()->route('listetudiants')->with('etat','L`etudiant a ete supprime !');

    }
    //fonction qui permet de chercher un etudiant dans la liste
    public function rechercherEtudiants(Request $request){

        $recherche =$request->get('search');

        $etudiant = Etudiant::where('nom','like',"{$recherche}")->orWhere('prenom','like',"{$recherche}")

            ->orWhere('noet','like',"{$recherche}")->paginate(3);

        return view('etudiant.liste',['etudiants'=>$etudiant]);
    }
    //fonction qui renvoie le formulaire pour associer un etudiant a un cours
    public function associerEtudiantsCoursForm(){

        $etudiant = DB::table('etudiants')->get();

        return view('cours.associer_etudiant',['etudiants'=>$etudiant]);
    }
    //fonction qui permet d'associer un etudiant a un cours
    public function associerEtudiantsCours(Request $request,$cours_id)

    {
        $etudiant = Etudiant::find($request->etudiant_id);
        if(!empty($etudiant)) {
            try {
                $etudiant->cours()->attach($cours_id);

                $request->session()->flash('etat', "L`etudiant est inscrit dans ce cours !");
            } catch (\Exception) {

                $request->session()->flash('etat', "L`etudiant a deja ete inscrit dans ce cours !");

            }
            $etudiant->save();

            return redirect('/');
        }else{
            return back()->withErrors([
                'etudiant'=>'Aucun etudiant a inscrire !',
            ]);

        }

    }
    //fonction qui renvoie le formulaire pour dissocier un etudiant d'un cours
    public function dissocierEtudiantForm($id){

        $cour = Cour::findOrFail($id);

        //dd($cour);

        return view ('cours.dissocier_etudiant',compact('cour'));

    }
    //fonction qqui permet de dissocier un etudiant d'un cours
    public function dissocierEtudiant(Request $request, $cours_id){

        $etudiant = Etudiant::find($request->etudiant_id);

        //8$cour =Cour::find($cours_id);
        if(!empty($etudiant)){

            $cour =Cour::find($cours_id);
            foreach ($cour->seances as $seance){
                DB::delete('delete from presences where seance_id =?',[$seance->id]);

                DB::delete('delete from presences where etudiant_id =?',[$etudiant->cour]);

            }

            $etudiant->cours()->detach($cours_id);

            $etudiant->save();

            $request->session()->flash('etat', "L`etudiant a ete desinscrit dans ce cours !");

            return redirect('/');

        }else{
            return back()->withErrors([
                'etudiant'=>'Aucun etudiant pour desinscrire !',
            ]);
        }

    }
    //fonction qui renvoie le formulaire pour associer plusieurs etudiant a un cours
    public function associerPlusieursEtudiantForm(){

        $etudiant = DB::table('etudiants')->get();

        return view('cours.associer_plusieurs_etudiant',['etudiants'=>$etudiant]);

    }
    //fonction qui permet d'associer plusieurs etudiant a un cours
    public function associerPlusieursEtudiant(Request $request,$cours_id)
    {

        $etudiants = Etudiant::find($request->etudiant_id);
        if(empty($etudiants)){
            return back()->withErrors([
                'etudiant'=>'Aucun etudiant a inscrire !',
            ]);
        }
        foreach ($etudiants as $etudiant) {
            $request->etudiant_id = $etudiant;


            try {
                $etudiant->cours()->attach($cours_id);

            } catch (\Exception) {

                $etudiant->update();
            }
            $etudiant->save();
        }

        $request->session()->flash('etat', 'Les etudiants ont ete inscrit a ce cours !');

        return redirect('/');
        }

    //fonction qui renvoie le formulaire pour dissocier plusieurs etudiant d'un cours
    public function dissocierPlusieursEtudiantForm($id){

        $cour = Cour::findOrFail($id);

        //dd($cour);

        $cour->with('etudiants')->get();

        return view ('cours.dissocier_plusieurs_etudiant',compact('cour'));

    }
    //fonction qpermet de dissocier plusieurs etudiant d'un cours
    public function dissocierPlusieursEtudiant(Request $request,$cours_id){

        $etudiants =Etudiant::find($request->etudiant_id);
        if(empty($etudiants)) {
            return back()->withErrors([
                'etudiant' => 'Aucun etudiant a inscrire !',
            ]);
        }

        foreach($etudiants as $etudiant) {

           $request->etudiant_id = $etudiant;
            $cour =Cour::find($cours_id);
            foreach ($cour->seances as $seance){
                DB::delete('delete from presences where seance_id =?',[$seance->id]);

                DB::delete('delete from presences where etudiant_id =?',[$etudiant->cour]);

            }

           $etudiant->cours()->detach($cours_id);

           $etudiant->save();
        }

        $request->session()->flash('etat', 'Les etudiants ont ete associes a ce cours !');

        return redirect('/');

    }
    //fonction qui afficher la liste des etudiants associes a un cours
    public function listeEtudiantsAssocies($id)
    {
        $cour = Cour::findOrFail($id);

        //$cour->with('etudiants')->get();

        return view ('cours.liste_etudiant_associe',compact('cour'));

    }
    //fonction qui renvoie le formulaire pour associer un enseignant a un cours
    public function associerEnseignantForm()
    {
        $user = User::where('type', 'enseignant')->get();

        return view('cours.associer_enseignant', ['users' => $user]);
    }
    //fonction qui permet d'associer un enseignant a un cours
    public function associerEnseignant(Request $request, $cours_id)
    {

        $user = User::find($request->user_id);
        if(!empty($user)) {


            try {
                $user->cours()->attach($cours_id);

                $request->session()->flash('etat', 'L`enseignant est associe a ce cours !');

            } catch (\Exception) {

                $request->session()->flash('etat', 'L`enseignant a deja ete associe ce cours !');

                //return redirect('/');
            }

            $user->save();

            return redirect('/');

        }else{
            return back()->withErrors([
                'enseignant'=>'Aucun enseignant a associer !',
            ]);
        }

    }
    //fonction qui renvoie le formulaire pour dissocier un enseignant d'un cours
    public function dissocierEnseignantForm($id){

        $cour = Cour::findOrFail($id);

        //dd($cour);

        return view ('cours.dissocier_enseignant',compact('cour'));

    }
    //fonction qui permer de dissocier un enseignant d'un cours
    public function dissocierEnseignant(Request $request, $cours_id){

        $user = User::find($request->user_id);
        if(!empty($user)) {

            $user->cours()->detach($cours_id);

            $user->save();

            $request->session()->flash('etat', 'L`enseignant a ete dissocie de ce cours !');

            return redirect('/');
        }else{
            return back()->withErrors([
                'enseignant'=>'Aucun enseignant a dissocier !',
            ]);
        }

    }
    //fonction qui renvoie le formulaire pour associer plusieurs enseignant d'un coup a un cours
    public function associerPlusieursEnseignantForm()
    {
        $user = User::where('type','enseignant')->get();

        return view('cours.associer_plusieurs_enseignant', ['users' => $user]);
    }
    //fonction qui permet d'associer plusieurs enseignant d'un coup a un cours
    public function associerPlusieursEnseignant(Request $request,$cours_id)
    {
        $users =User::find($request->user_id);
        if(empty($users)){
            return back()->withErrors([
                'enseignant'=>'Aucun enseignant a associer !',
            ]);
        }

        foreach($users as $user) {

            $request->user_id = $user;

            try {
                $user->cours()->attach($cours_id);

            }catch (\Exception){
                $user->update();

            }
            $user->save();

        }
        $request->session()->flash('etat', 'Les enseignants ont ete associe a ce cours !');

        return redirect('/');

    }
    //fonction qui renvoie le formulaire pour dissocier plusieurs enseignant d'un coup d'un cours
    public function dissocierPlusieursEnseignantForm($id){

        $cour = Cour::findOrFail($id);

        return view ('cours.dissocier_plusieurs_enseignant',compact('cour'));

    }
    //fonction qui permet de dissocier plusieurs enseignant d'un coup d'un cours
    public function dissocierPlusieursEnseignant(Request $request,$cours_id){

        $users =User::find($request->user_id);
        if(empty($users)){
            return back()->withErrors([
                'enseignant'=>'Aucun enseignant a dissocier !',
            ]);
        }

        foreach($users as $user) {

            $request->user_id = $user;

            $user->cours()->detach($cours_id);

            $user->save();

        }

        $request->session()->flash('etat', 'Les enseignants ont ete dissocies de ce cours !');

        return redirect('/');

    }
    //fonction qui affiche la liste des enseignants associes a un cours
    public function listeEnseignantAssocies($id)
    {
        $cour = Cour::findOrFail($id);

        //dd($cour);

        return view ('cours.liste_enseignant_associe',compact('cour'));

    }
    public function copierAssociationForm($id){

        //$cour  =  Cour::where('id', $id)->firstOrFail();
        $cour =Cour::findOrFail($id);

        $c =Cour::where('id','!=',$cour->id)->get();
        //dd($c);
        return view('cours.copier_association',['cours'=>$c]);
    }
    public function copierAssociation(Request $request,$id){

        //$etudiants =Etudiant::find($id);

        $cour =Cour::findOrFail($id);

        $etudiants=$cour->etudiants;

        $c = Cour::find($request->id);

        $cour=$c->id;

        foreach($etudiants as $etudiant){

            $request->etudiant_id = $etudiant;
            try {
                $etudiant->cours()->attach($cour);

            }catch (\Exception){
                $etudiant->update();
            }

            $etudiant->save();

        }
        $request->session()->flash('etat', 'Les association etudiants ont ete copies a ce cours !');

        return redirect('/');

    }
}
