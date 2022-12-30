@extends('modele')

@section('title','Modification des utilisateurs')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/creation_formulaire.css') }}">

    <form action="{{route('modifierutilisateurs',['id'=>$users->id])}}" method=post>
        <h3>Modification des utilisateurs</h3>
        @csrf
        Nom:<br>
        <input type="text" name="nom" value="{{$users->nom}}"><br>
        Prenom<br>
        <input type="text" name="prenom" value="{{$users->prenom}}"><br>
        Login<br>
        <input type="text" name="login" value="{{$users->login}}" disabled><br>
        Nouveau Mot de passe<br>
        <input type="password" name="mdp"><br>
        Confirmation de mot de passe<br>
        <input type="password" name="mdp_confirmation"><br>
        <br>
        Type<br>
        <br>
        <select id="type" name="type">
            <option value="enseignant">Enseignant</option>
            <option value="gestionnaire">Gestionnaire</option>
            <option value="admin">Admin</option>
        </select><br>
        <br>
        <input style="width:210px;background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" name="Modifier" value="Mettre a jour"> <br>
        <br>
        <input style="width:210px;background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" name="Annuler" value="Annuler">
    </form>
@endsection
