@extends('modele')

@section('title','Liste des etudiants')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a><br>
    <br>
    @if(sizeof($etudiants)==0)
        <h1>Aucun etudiant !</h1>

    @else
    <form action="{{route('rechercheretudiants')}}" method="get">
        @csrf
        <input style="width:300px;height:25px;" type="text" name="search" placeholder="Rechercher un etudiant..">
        <input style="color: #fff;background-color: #2A6881;border-color: #2A6881;"type="submit" name="Envoyer" value="Recherche">
    </form>
    <h3>Liste des etudiants</h3>
    <table>
        <th>Id</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Numero d'etudiant</th>
        <th>Modification</th>
        <th>Suppression</th>
        <th>Seances</th>

        @foreach($etudiants as $etudiant)
            <tr>
                <td>{{$etudiant->id}}</td>
                <td>{{$etudiant->nom}}</td>
                <td>{{$etudiant->prenom}}</td>
                <td>{{$etudiant->noet}}</td>
                <td><a href="{{route('modifieretudiantsform',['id'=>$etudiant->id])}}">Modifier</a></td>
                <td><a href="{{route('supprimeretudiantsform',['id'=>$etudiant->id])}}">Supprimer</a></td>
                <td><a href="{{route('listepresencesetudiant',['id'=>$etudiant->id])}}">Presences</a></td>

            </tr>
        @endforeach
        @endif
    </table>
    {{$etudiants->links()}}
@endsection
