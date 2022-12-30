@extends('modele')

@section('title','Liste des presences')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    @if(sizeof($etudiants )==0)
        <h1>Aucun etudiant present a la seance de {{$seance->date_debut}} !</h1>
    @else
    <br>
    <h3>Etudiants presents a la seance de {{$seance->date_debut}}</h3>
    <table>
        <th>Id</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Numero d'etudiant</th>

        @foreach($etudiants as $etudiant)
        <tr>
            <td>{{$etudiant->id}}</td>
            <td>{{$etudiant->nom}}</td>
            <td>{{$etudiant->prenom}}</td>
            <td>{{$etudiant->noet}}</td>
        </tr>
        @endforeach
        @endif
    </table>
@endsection
