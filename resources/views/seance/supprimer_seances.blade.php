@extends('modele')

@section('title','Suppression de la seance')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">

    <p>Voulez-vous supprimer la seance {{$seances->id}} ?</p>
    <form action="{{route('supprimerseances',['id'=>$seances->id])}}" method="post">
        @csrf
        <input type="submit" value="Supprimer">
    </form>
    <br>
    <button><a href="{{route('listeseances')}}" type="submit" value="Annuler">Annuler</a></button>
@endsection
