@extends('modele')

@section('title','Liste des seances')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <br>
    @if(sizeof($seances)==0)
        <h1>Aucune seance!</h1>
    @else
    <h3>Liste des seances</h3>
    <table>
        <th>Id</th>
        <th>Cours_id</th>
        <th>Date_debut</th>
        <th>Date_fin</th>
        <th>Modification</th>
        <th>Suppression</th>
        <th>Presences</th>
        @foreach($seances as $seance)
            <tr>
                <td>{{$seance->id}}</td>
                <td>{{$seance->cours_id}}</td>
                <td>{{$seance->date_debut}}</td>
                <td>{{$seance->date_fin}}</td>
                <td><a href="{{route('modifierseancesform',['id'=>$seance->id])}}">Modifier</a></td>
                <td><a href="{{route('supprimerseancesform',['id'=>$seance->id])}}">Supprimer</a></td>
                <td><a href="{{route('listepresents',['id'=>$seance->id])}}">Etudiant presents</a></td>
            </tr>
        @endforeach
        @endif
    </table>
    {{$seances->links()}}
@endsection
