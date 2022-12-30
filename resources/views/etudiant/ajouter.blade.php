@extends('modele')

@section('title','Creation des etudiants')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/creation_formulaire.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <form action="{{route('creeretudiants')}}" method="post">
        <h2>Creation des etudiants</h2>
        @csrf
        <label for="nom">Nom</label><br>
        <input type="text" name="nom" placeholder="Nom"><br>
        <label for="prenom">Prenom</label><br>
        <input type="text" name="prenom" placeholder="Prenom"><br>
        <label for="noet">Numero d'étudiant</label><br>
        <input type="integer" name="noet" placeholder="Numero etudiant"><br>
        <br>
        <button style="background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" value="Envoyer">Creer</button>

@endsection
