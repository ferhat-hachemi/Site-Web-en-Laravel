<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
//Page home
Route::get('/',[\App\Http\Controllers\HomeController::class,'home'])->name('home');

//Route qui permet de s'enregistrer
Route::get('/register',[\App\Http\Controllers\RegisterController::class,'registerForm'])->name('registerform');
Route::post('/register',[\App\Http\Controllers\RegisterController::class,'register'])->name('register');

//Route qui permet de se connecter
Route::get('/login',[\App\Http\Controllers\AuthentificationController::class,'loginForm'])->name('loginform');
Route::post('/login',[\App\Http\Controllers\AuthentificationController::class,'login']);

//Route qui permet de se deconnecter
Route::get('/logout',[\App\Http\Controllers\AuthentificationController::class,'logout'])->name('logout')->middleware('auth');

//liste des utilisateurs
Route::get('/listeuser',[\App\Http\Controllers\AdminController::class,'listetousUtilisateurs'])->name('listetousutilisateurs')->middleware('is_admin');

//Liste des utilisateurs en attente de validation
Route::get('/listeattente',[\App\Http\Controllers\AdminController::class,'listeUtilisateursattente'])->name('listeUtilisateursattente')->middleware('is_admin');

//Liste des admins
Route::get('/listeuser/admin',[\App\Http\Controllers\AdminController::class,'listeAdmin'])->name('listeadmin')->middleware('is_admin');

//Liste des enseignants
Route::get('/listeuser/enseignant',[\App\Http\Controllers\AdminController::class,'filtrerUtilisateursEnseignant'])->name('filtrerutilisateursenseignant')->middleware('is_admin');

//Liste des gestionnaires
Route::get('/listeuser/gestionnaire',[\App\Http\Controllers\AdminController::class,'filtrerUtilisateursGestionnaire'])->name('filtrerutilisateursgestionnaire')->middleware('is_admin');

//Acceptation des nouveaux utilisateurs
Route::get('/listeattente/{id}/accepter',[\App\Http\Controllers\AdminController::class,'accepterForm'])->name('accepterform')->middleware('is_admin');
Route::post('/listeattente/{id}/accepter',[\App\Http\Controllers\AdminController::class,'accepterUtilisateurs'])->name('accepterutilisateurs')->middleware('is_admin');

//Refus des nouveaux utilisateurs /Supprimer un utilisateur
Route::get('/listeattente/{id}/refuser',[\App\Http\Controllers\AdminController::class,'refuserForm'])->name('refuserform')->middleware('is_admin');
Route::post('/listattente/{id}/refuser',[\App\Http\Controllers\AdminController::class,'refuserUtilisateurs'])->name('refuserutilisateurs')->middleware('is_admin');

//Rechercher un utilisateur
Route::get('/rechercheuser',[\App\Http\Controllers\AdminController::class,'rechercherUtilisateurs'])->name('rechercherutilisateurs')->middleware('is_admin');

//Creer un nouveau utilisateur
Route::get('/creeruser',[\App\Http\Controllers\AdminController::class,'creerutilisateursForm'])->name('creerutilisateursform')->middleware('is_admin');
Route::post('/creeruser',[\App\Http\Controllers\AdminController::class,'creerUtilisateurs'])->name('creerutilisateurs')->middleware('is_admin');

//Modifier un utilisateur
Route::get('listeuser/{id}/modifier',[\App\Http\Controllers\AdminController::class,'modifierUtilisateursForm'])->name('modifierutilisateursform')->middleware('is_admin');
Route::post('listeuser/{id}/modifier',[\App\Http\Controllers\AdminController::class,'modifierUtilisateurs'])->name('modifierutilisateurs')->middleware('is_admin');


//Route qui permet a l'utilisateur de modifier son compte(Nom/prenom)
Route::get('/settings/{id}/compte',[\App\Http\Controllers\UserController::class,'modifiercompteForm'])->name('modifiercompteform')->middleware('auth');
Route::post('/settings/{id}/compte',[\App\Http\Controllers\UserController::class,'modifierCompte'])->name('modifiercompte')->middleware('auth');

//Route qui permet a l'utilisateur de modifier son mot de passe
Route::get('/settings/mot_de_passe',[\App\Http\Controllers\UserController::class,'modifiermotdepasseForm'])->name('modifiermotdepasseform')->middleware('auth');
Route::post('/settings/mot_de_passe',[\App\Http\Controllers\UserController::class,'modifierMotdepasse'])->name('modifiermotdepasse')->middleware('auth');

//Liste des cours
Route::get('/listecours',[\App\Http\Controllers\CoursController::class,'listeCours'])->name('listecours')->middleware('is_gestionnaire');

//Rechercher un cours
Route::get('/recherchercours',[\App\Http\Controllers\CoursController::class,'rechercherCours'])->name('recherchercours')->middleware('auth');

//Creer un nouveau cours
Route::get('/creercours',[\App\Http\Controllers\CoursController::class,'creercoursForm'])->name('creercoursform')->middleware('is_gestionnaire');
Route::post('/creercours',[\App\Http\Controllers\CoursController::class,'creerCours'])->name('creercours')->middleware('is_gestionnaire');

//Modifier un cours
Route::get('/listecours/{id}/modifier',[\App\Http\Controllers\CoursController::class,'modifierCoursForm'])->name('modifiercoursform')->middleware('is_gestionnaire');
Route::post('/listecours/{id}/modifier',[\App\Http\Controllers\CoursController::class,'modifierCours'])->name('modifiercours')->middleware('is_gestionnaire');

//Supprimer un cours
Route::get('/listecours/{id}/supprimer',[\App\Http\Controllers\CoursController::class,'supprimerCoursForm'])->name('supprimercoursform')->middleware('is_gestionnaire');
Route::post('/listecours/{id}/supprimer',[\App\Http\Controllers\CoursController::class,'supprimerCours'])->name('supprimercours')->middleware('is_gestionnaire');

//Liste des etudiants
Route::get('/listetudiants',[\App\Http\Controllers\GestionnaireController::class,'listeEtudiants'])->name('listetudiants')->middleware('is_gestionnaire');

//Rechercher un etudiant
Route::get('/rechercheretudiant',[\App\Http\Controllers\GestionnaireController::class,'rechercherEtudiants'])->name('rechercheretudiants')->middleware('is_gestionnaire');

//Creer un nouveau etudiant
Route::get('/creeretudiant',[\App\Http\Controllers\GestionnaireController::class,'creeretudiantsForm'])->name('creeretudiantsform')->middleware('is_gestionnaire');
Route::post('/creeretudiant',[\App\Http\Controllers\GestionnaireController::class,'creerEtudiants'])->name('creeretudiants')->middleware('is_gestionnaire');

//Modifier un etudiant
Route::get('/listetudiants/{id}/modifier',[\App\Http\Controllers\GestionnaireController::class,'modifierEtudiantsForm'])->name('modifieretudiantsform')->middleware('is_gestionnaire');
Route::post('/listetudiants/{id}/modifier',[\App\Http\Controllers\GestionnaireController::class,'modifierEtudiants'])->name('modifieretudiants')->middleware('is_gestionnaire');

//Supprimer un etudiant
Route::get('/listetudiants/{id}/supprimer',[\App\Http\Controllers\GestionnaireController::class,'supprimerEtudiantsForm'])->name('supprimeretudiantsform')->middleware('is_gestionnaire');
Route::post('/listetudiants/{id}/supprimer',[\App\Http\Controllers\GestionnaireController::class,'supprimerEtudiants'])->name('supprimeretudiants')->middleware('is_gestionnaire');

//Liste des seances
Route::get('/listeseance',[\App\Http\Controllers\SeanceController::class,'listeSeances'])->name('listeseances')->middleware('is_gestionnaire');

//Liste des seances pour un cours
Route::get('/listeseance/{id}/cours',[\App\Http\Controllers\SeanceController::class,'listeSeancesCours'])->name('listeseancescours')->middleware('auth');

//Creation d'une nouvelle seance de cours
Route::get('/creerseance/{id}/creer',[\App\Http\Controllers\SeanceController::class,'creerSeancesForm'])->name('creerseancesform')->middleware('is_gestionnaire');
Route::post('/creerseance/{id}/creer',[\App\Http\Controllers\SeanceController::class,'creerSeances'])->name('creerseances')->middleware('is_gestionnaire');

//Modifier une seance de cours
Route::get('/listeseance/{id}/modifier',[\App\Http\Controllers\SeanceController::class,'modifierSeancesForm'])->name('modifierseancesform')->middleware('is_gestionnaire');
Route::post('/listeseance/{id}/modifier',[\App\Http\Controllers\SeanceController::class,'modifierSeances'])->name('modifierseances')->middleware('is_gestionnaire');

//Supprimer une seance de cours
Route::get('/listeseance/{id}/supprimer',[\App\Http\Controllers\SeanceController::class,'supprimerSeancesForm'])->name('supprimerseancesform')->middleware('is_gestionnaire');
Route::post('/listeseance/{id}/supprimer',[\App\Http\Controllers\SeanceController::class,'supprimerSeances'])->name('supprimerseances')->middleware('is_gestionnaire');


//Liste des enseignants associes aux cours
Route::get('/listeenseignantassocié/{id}',[\App\Http\Controllers\GestionnaireController::class,'listeEnseignantAssocies'])->name('listeenseignantassocies')->middleware('is_gestionnaire');

//Association des enseignants aux cours
Route::get('/associer/{id}/enseignant',[\App\Http\Controllers\GestionnaireController::class,'associerEnseignantForm'])->name('associerenseignantform')->middleware('is_gestionnaire');
Route::post('/associer/{id}/enseignant',[\App\Http\Controllers\GestionnaireController::class,'associerEnseignant'])->middleware('is_gestionnaire');

//Dissociation des enseignants des cours
Route::get('/dissocier/{id}/enseignant',[\App\Http\Controllers\GestionnaireController::class,'dissocierEnseignantForm'])->name('dissocierenseignantform')->middleware('is_gestionnaire');
Route::post('/dissocier/{id}/enseignant',[\App\Http\Controllers\GestionnaireController::class,'dissocierEnseignant'])->middleware('is_gestionnaire');

//Association de plusieurs enseignants aux cours
Route::get('/associerplusieurs/{id}/enseignant',[\App\Http\Controllers\GestionnaireController::class,'associerPlusieursEnseignantForm'])->name('associerplusieursenseignantform')->middleware('is_gestionnaire');
Route::post('/associerplusieurs/{id}/enseignant',[\App\Http\Controllers\GestionnaireController::class,'associerPlusieursEnseignant'])->middleware('is_gestionnaire');

//Dissociation de plusieurs enseignants des cours
Route::get('/dissocierplusieurs/{id}/enseignants',[\App\Http\Controllers\GestionnaireController::class,'dissocierPlusieursEnseignantForm'])->name('dissocierplusieursenseignantform')->middleware('is_gestionnaire');
Route::post('/dissocierplusieurs/{id}/enseignants',[\App\Http\Controllers\GestionnaireController::class,'dissocierPlusieursEnseignant'])->middleware('is_gestionnaire');
//Liste des etudiants associes aux cours
Route::get('/listeetudiantsassocié/{id}',[\App\Http\Controllers\GestionnaireController::class,'listeEtudiantsAssocies'])->name('listeetudiantsassocies')->middleware('auth');

//Association des etudiants aux cours
Route::get('/associer/{id}/etudiants',[\App\Http\Controllers\GestionnaireController::class,'associerEtudiantsCoursForm'])->name('associeretudiantscoursform')->middleware('is_gestionnaire');
Route::post('/associer/{id}/etudiants',[\App\Http\Controllers\GestionnaireController::class,'associerEtudiantsCours'])->middleware('is_gestionnaire');

//Dissociation des etudiants des cours
Route::get('/dissocier/{id}/etudiant',[\App\Http\Controllers\GestionnaireController::class,'dissocierEtudiantForm'])->name('dissocieretudiantform')->middleware('is_gestionnaire');
Route::post('/dissocier/{id}/etudiant',[\App\Http\Controllers\GestionnaireController::class,'dissocierEtudiant'])->middleware('is_gestionnaire');

//Association de plusieurs etudiants aux cours
Route::get('/associerplusieurs/{id}/etudiant',[\App\Http\Controllers\GestionnaireController::class,'associerPlusieursEtudiantForm'])->name('associerplusieursetudiantform')->middleware('is_gestionnaire');
Route::post('/associerplusieurs/{id}/etudiant',[\App\Http\Controllers\GestionnaireController::class,'associerPlusieursEtudiant'])->middleware('is_gestionnaire');

//Dissociation de plusieurs etudiants des cours
Route::get('/dissocierplusieurs/{id}/etudiant',[\App\Http\Controllers\GestionnaireController::class,'dissocierPlusieursEtudiantForm'])->name('dissocierplusieursetudiantform')->middleware('is_gestionnaire');
Route::post('/dissocierplusieurs/{id}/etudiant',[\App\Http\Controllers\GestionnaireController::class,'dissocierPlusieursEtudiant'])->middleware('is_gestionnaire');
//Liste des cours associe pour un enseignant
Route::get('/liste/{id}/associe',[\App\Http\Controllers\CoursController::class,'listCoursEnseignant'])->name('listcoursenseignant')->middleware('is_enseignant');

//Pointage des etudiants dans les seances
Route::get('/pointer/{id}/etudiant',[\App\Http\Controllers\SeanceController::class,'pointerEtudiantForm'])->name('pointeretudiantform')->middleware('is_enseignant');
Route::post('/pointer/{id}/etudiant',[\App\Http\Controllers\SeanceController::class,'pointerEtudiant'])->name('pointeretudiant')->middleware('is_enseignant');

//Pointage de plusieurs etudiants dans les seances
Route::get('/pointerplusieurs/{id}/etudiants',[\App\Http\Controllers\SeanceController::class,'pointerPlusieursEtudiantsForm'])->name('pointerplusieursetudiantsform')->middleware('is_enseignant');
Route::post('/pointerplusieurs/{id}/etudiants',[\App\Http\Controllers\SeanceController::class,'pointerPlusieursEtudiants'])->name('pointerplusieursetudiants')->middleware('is_enseignant');

//Liste des etudiants presents a une seances
Route::get('/liste/{id}/presents',[\App\Http\Controllers\SeanceController::class,'listePresents'])->name('listepresents')->middleware('auth');
Route::get('/liste/{id}/absents',[\App\Http\Controllers\SeanceController::class,'listeAbsents'])->name('listeabsents')->middleware('auth');

//Liste des presences pour un etudiant
Route::get('/liste/{id}/presences',[\App\Http\Controllers\SeanceController::class,'listePresencesEtudiant'])->name('listepresencesetudiant')->middleware('is_gestionnaire');

//Copier les association (Etudiant) d'un cours vers un autre cours
Route::get('/copier/{id}/association',[\App\Http\Controllers\GestionnaireController::class,'copierAssociationForm'])->name('copierassociationform');
Route::post('/copier/{id}/association',[\App\Http\Controllers\GestionnaireController::class,'copierAssociation']);

