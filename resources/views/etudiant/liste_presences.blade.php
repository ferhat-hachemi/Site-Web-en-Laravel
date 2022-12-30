@extends('modele')

@section('title','Liste des presences')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <br>
    @if(sizeof($seances)==0)
        <h1>Aucune seance pour l'etudiant {{$etudiant->nom}} {{$etudiant->prenom}} !</h1>
    @else
    <h3>Liste des presences pour l'etudiant:<p style="color: #2A6881;font-family: 'Times New Roman';">{{$etudiant->nom}} {{$etudiant->prenom}}</p></h3>
    <table>
        <th>Id</th>
        <th>Cours_id</th>
        <th>Date_debut</th>
        <th>Date_fin</th>
        @foreach($seances as $seance)
            <tr>
                <td>{{$seance->id}}</td>
                <td>{{$seance->cours_id}}</td>
                <td>{{$seance->date_debut}}</td>
                <td>{{$seance->date_fin}}</td>
            </tr>
        @endforeach
        @endif
    </table>
@endsection
