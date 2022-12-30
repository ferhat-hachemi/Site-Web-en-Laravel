@extends('modele')

@section('title','Liste des seances d`un cours')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <br>
    @if(sizeof($seances)==0)
        <h1>Aucune seance pour le cours de {{$cour->intitule}} !</h1>
    @else
    <h3>Liste des seances pour le cours de</h3>
    <table>
        <th>Id</th>
        <th>Cours_id</th>
        <th>Date_debut</th>
        <th>Date_fin</th>
        @if(Auth::user()->isAdmin() || Auth::user()->Gestionnaire())
        <th>Modification</th>
        <th>Suppression</th>
        @endif
        <th>Presences</th>
        @foreach($seances as $seance)
            <tr>
                <td>{{$seance->id}}</td>
                <td>{{$seance->cours_id}}</td>
                <td>{{$seance->date_debut}}</td>
                <td>{{$seance->date_fin}}</td>
                @if(Auth::user()->isAdmin() || Auth::user()->Gestionnaire())
                <td><a href="{{route('modifierseancesform',['id'=>$seance->id])}}">Modifier</a></td>
                <td><a href="{{route('supprimerseancesform',['id'=>$seance->id])}}">Supprimer</a></td>
                @endif
                <td><a href="{{route('listepresents',['id'=>$seance->id])}}">Presents</a></td>
            </tr>
        @endforeach
    @endif
    {{$seances->links()}}
@endsection
