@extends('modele')

@section('title','Liste des cours associes')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <br>
    <h3>Mes cours</h3>

    <table>
        <th>Id</th>
        <th>Intitule</th>
        <th>Liste inscris</th>
        <th>Liste </th>
        <th>Pointage</th>
        @foreach($user ->cours as $cour)
            <tr>
                <td>{{$cour->id}}</td>
                <td>{{$cour->intitule}}</td>
                <td><a href="{{route('listeetudiantsassocies',['id'=>$cour->id])}}">Etudiant</a> </td>
                <td><a href="{{route('listeseancescours',['id'=>$cour->id])}}">Seance</a></td>
                <td><a href="{{route('pointeretudiantform',['id'=>$cour->id])}}">Etudiant</a>/<a href="{{route('pointerplusieursetudiantsform',['id'=>$cour->id])}}">Plusieurs</a></td>
            </tr>
        @endforeach
    </table>
@endsection
