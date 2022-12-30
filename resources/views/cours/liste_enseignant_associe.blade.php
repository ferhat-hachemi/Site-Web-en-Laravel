@extends('modele')

@section('title','Liste des enseignant associes')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <br>
    @if(sizeof($cour ->users)==0)
        <h1>Aucun enseignant est responsable de cours de {{$cour->intitule}} !</h1>
    @else
    <h3>Enseignants du cours de {{$cour->intitule}}</h3>

    <table>
        <th>Id</th>
        <th>Nom</th>
        <th>Prenom</th>
        @foreach($cour ->users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->nom}}</td>
            <td>{{$user->prenom}}</td>
        </tr>
        @endforeach
        @endif
    </table>
@endsection
