@extends('modele')

@section('title','Suppression des cours')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">

    <p>Voulez-vous supprimer le cours {{$cours->intitule}} ?</p>
    <form action="{{route('supprimercours',['id'=>$cours->id])}}" method="post">
        @csrf
        <input type="submit" value="Supprimer">
    </form>
    <br>
    <button><a href="{{route('listecours')}}" type="submit" value="Annuler">Annuler</a></button>
@endsection
