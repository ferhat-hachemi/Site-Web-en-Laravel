@extends('modele')

@section('title','Liste des utilisateurs en attentes de validation')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;">Page principale</button></a>
    @if(sizeof($users)==0)
        <h1>Aucun utilisateur en attente de validation !</h1>
    @else
    <h3>Liste des utilisateurs non-valides</h3>
    <table>
        <th>Id</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Login</th>
        <th>Acceptation</th>
        <th>Refus</th>

        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->nom}}</td>
                <td>{{$user->prenom}}</td>
                <td>{{$user->login}}</td>
                <td><a href="{{route('accepterform',[$user['id']])}}" >Accepter</a></td>
                <td><a href="{{route('refuserform',[$user['id']])}}" >Refuser</a></td>
            </tr>
        @endforeach
        @endif
    </table>
@endsection
