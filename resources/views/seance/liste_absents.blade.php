@extends('modele')

@section('title','Liste des absents')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <br>
    <h3>Etudiants absents a la seance de</h3>
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
    </table>
@endsection
