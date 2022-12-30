@extends('modele')

@section('title','Modification des etudiants')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/creation_formulaire.css') }}">

    <form action="{{route('modifieretudiants',['id'=>$etudiants->id])}}" method="post">
        <h3>Modification des etudiants</h3>
        @csrf
        Nom<br>
        <input type="text" name="nom" value="{{$etudiants->nom}}"><br>
        Pénom<br>
        <input type="text" name="prenom" value="{{$etudiants->prenom}}"><br>
        Numero d'etudiant<br>
        <input type="integer" name="noet" value="{{$etudiants->noet}}" disabled><br>
        <br>
        <input style="width:210px;background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" name="Modifier" value="Mettre a jour"> <br>
        <br>
        <input style="width:210px;background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" name="Annuler" value="Annuler">
    </form>
@endsection
