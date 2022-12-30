@extends('modele')

@section('title','Liste des etudiants associes')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
   @if(sizeof($cour -> etudiants)==0)
       <h1>Aucun etudiant inscris aux cours de {{$cour->intitule}} !</h1>
   @else
    <br>
    <h3>Etudiants inscris aux cours de {{$cour->intitule}}</h3>
    <table>
        <th>Id</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Numero d'etudiant</th>
        @if(Auth::user()->isAdmin() || Auth::user()->Gestionnaire())
        <th>Seances</th>
        @endif
        @foreach($cour -> etudiants as $etudiant)
            <tr>
                <td>{{$etudiant->id}}</td>
                <td>{{$etudiant->nom}}</td>
                <td>{{$etudiant->prenom}}</td>
                <td>{{$etudiant->noet}}</td>
                @if(Auth::user()->isAdmin() || Auth::user()->Gestionnaire())
                <td><a href="{{route('listepresencesetudiant',['id'=>$etudiant->id])}}">Presences</a></td>
                @endif
            </tr>
        @endforeach
        @endif
    </table>
@endsection
