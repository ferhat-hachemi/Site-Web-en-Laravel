@extends('modele')

@section('title','Refus des utilisateurs')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">

    <p>Voulez-vous supprimer l'utilisateur {{$users->login}} ?</p>
    <form action="{{route('refuserutilisateurs',['id'=>$users->id])}}" method="post">
        @csrf
        <input type="submit" value="Supprimer">
    </form>
    <br>
    <button><a href="{{route('listetousutilisateurs')}}" type="submit" value="Annuler">Annuler</a></button>
@endsection
