<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\Etudiant;
use App\Models\Seance;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Support\Facades\DB;

class SeanceController extends Controller
{
    //fonction qui afficher la liste des seances pour un cours
    public function listeSeancesCours($id)
    {
        $cour = Cour::findOrFail($id);

        //$seance= Seance::simplePaginate(1);

        $seances = $cour->seances()->simplePaginate(3);

        //dd($cour);

        return view('cours.liste_seances_associe', ['seances' => $seances, 'cour' => $cour]);
    }

    //fonction qui afficher la liste de toutes les seances
    public function listeSeances()
    {
        $seance = DB::table('seances')->simplePaginate(3);

        return view('seance.liste_seances', ['seances' => $seance]);
    }

    //fonction qui renvoie le formulaire pour creer une seance de cours
    public function creerSeancesForm($id)
    {

        $cour = Cour::findOrFail($id);
        return view('seance.creer_seance', ['cours' => $cour]);
    }

    //fonction qui permet de creer une seance de cours
    public function creerSeances(Request $request, $id)
    {

        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date'
        ]);
        $cour = Cour::find($id);

        $seance = new Seance();
        //on associe la seance aux cours lors de la creation vu qu'on la cree a partir de cours
        $seance->cours()->associate($cour);

        $seance->date_debut = $request['date_debut'];

        $seance->date_fin = $request['date_fin'];

        //$seance=Seance::find($id);
        //$seance->cour()->associate($cour)->save();

        $seance->save();

        $request->session()->flash('etat', 'La seances a ete cree avec succes !');

        return redirect('/');
    }

    //fonction qui renvoie le formulaire pour modifier la seance de cours
    public function modifierSeancesForm($id)
    {

        $seance = Seance::findOrFail($id);

        return view('seance.modifier_seances', ['seances' => $seance]);

    }

    //fonction qui permet de modifier la seance de cours
    public function modifierSeances(Request $request, $id)
    {
        $seance = Seance::findOrFail($id);
        if ($request->has('Modifier')) {
            $request->validate([
                'date_debut' => 'required',
                'date_fin' => 'required'
            ]);
            $seance->date_debut = request('date_debut');
            $seance->date_fin = request('date_fin');

            $seance->save();

            $request->session()->flash('etat', 'La seance a ete modifiee !');
        } else {
            $request->session()->flash('etat', 'La modification a ete annulee !');
        }
        return redirect('/listeseance');
    }

    //fonction qui renvoie le formulaire pour supprimer la seance de cours
    public function supprimerSeancesForm($id)
    {
        $seance = Seance::findOrFail($id);
        return view('seance.supprimer_seances', ['seances' => $seance]);
    }

    //fonction qui permet de supprimer la seance de cours
    public function supprimerSeances($id)
    {
        $seance = Seance::findOrFail($id);

        DB::delete('delete from presences where seance_id=?', [$seance->id]);

        $seance->delete();

        return redirect()->route('listeseances')->with('etat', 'La seance a ete supprimee !');

    }

    //fonction qui renvoie le formulaire pour pointer un etudiant dans une seance
    public function pointerEtudiantForm($id)
    {

        $seance = Seance::find($id);

        $cour = Cour::find($id);

        return view('seance.pointer_etudiant', compact('cour'), ['seances' => $seance]);
    }

    //fonction qui permet de pointer un etudiant dans une seance
    public function pointerEtudiant(Request $request)
    {

        $etudiant = Etudiant::find($request->etudiant_id);

        $seance = Seance::find($request->seance_id);
        if (!empty($etudiant) && !empty($seance)) {

            try {
                $etudiant->seances()->attach($seance);

                $request->session()->flash('etat', 'L`etudiant a ete marque present !');

            } catch (\Exception) {

                $request->session()->flash('etat', 'L`etudiant a deja ete marque present !');

            }

            $etudiant->save();

            return redirect('/');
        } else {
            return back()->withErrors([
                'seance' => 'Aucun etudiant ou aucune seance pour pointer !',
            ]);

        }
    }

    //fonction qui renvoie le formulaire pour pointer plusieurs etudiants d'un coup dans une seance
    public function pointerPlusieursEtudiantsForm($id)
    {
        $cour = Cour::findOrFail($id);

        $seance = Seance::find($id);

        return view('seance.pointer_plusieurs_etudiant', compact('cour'), ['seances' => $seance]);

    }

    //fonction qui rpermet de pointer plusieurs etudiants d'un coup dans une seance
    public function pointerPlusieursEtudiants(Request $request,)
    {

        $etudiants = Etudiant::find($request->etudiant_id);

        $seance = Seance::find($request->seance_id);

        if(empty($etudiants) || empty($seance)){
            return back()->withErrors([
                'etudiant'=>'Aucun etudiant ou aucune seance pour pointer !',
            ]);
        }

        foreach ($etudiants as $etudiant) {

            $request->etudiant_id = $etudiant;
            try {
                $etudiant->seances()->attach($seance);

            } catch (\Exception) {

                $etudiant->update();
            }

            $etudiant->save();

        }
        $request->session()->flash('etat', 'Les etudiants ont ete marques presents !');

        return redirect('/');

    }
    //liste des etudiants presents dans une seance
    public function listePresents($id)
    {

        $seance = Seance::findOrfail($id);

        $etudiants = $seance->etudiants;

        return view('seance.liste_presents', compact('seance'), ['etudiants' => $etudiants]);

    }
    //liste des presences pour un etudiant
    public function listePresencesEtudiant($id)
    {

        $etudiant = Etudiant::findOrFail($id);

        $seances = $etudiant->seances;

        return view('etudiant.liste_presences', compact('etudiant'), ['seances' => $seances]);

    }

}
