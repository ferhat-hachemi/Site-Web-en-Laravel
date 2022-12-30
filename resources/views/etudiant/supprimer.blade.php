@extends('modele')

@section('title','Suppression des etudiants')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">

    <p>Voulez-vous supprimer l'etudiant {{$etudiants->nom}} {{$etudiants->prenom}}?</p>
    <form action="{{route('supprimeretudiants',['id'=>$etudiants->id])}}" method="post">
        @csrf
        <input type="submit" value="Supprimer">
    </form>
    <br>
    <button><a href="{{route('listetudiants')}}" type="submit" value="Annuler">Annuler</a></button>
@endsection
