@extends('modele')

@section('title','Liste des utilisateurs')

@section('contenu')

    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;">Page principale</button></a><br>
    <br>
    <form action="{{route('rechercherutilisateurs')}}" method="get">
        @csrf
        <input style="width:300px;height:25px;" type="text" name="search" placeholder="Rechercher un utilisateur..">
        <input style="color: #fff;background-color: #2A6881;border-color: #2A6881;" type="submit" name="naEnvoyer" value="Recherche">
    </form>
    <br>
    <div class="dropdown">
        <button class="boutonmenuprincipal">Filtrer</button>
        <div class="dropdown-liste">
            <a href="{{route('listetousutilisateurs')}}">Integrale</a>
            <a href="{{route('listeadmin')}}">Admin</a>
            <a href="{{route('filtrerutilisateursenseignant')}}">Enseignant</a>
            <a href="{{route('filtrerutilisateursgestionnaire')}}">Gestionnaire</a>
        </div>
    </div> <br>
    <h3>Liste des utilisateurs</h3>
    <table>
        <th>Id</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Login</th>
        <th>Type</th>
        <th>Modification</th>
        <th>Suppression</th>
        <th>Liste</th>

        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->nom}}</td>
                <td>{{$user->prenom}}</td>
                <td>{{$user->login}}</td>
                <td>{{$user->type}}</td>
                <td><a href="{{route('modifierutilisateursform',[$user['id']])}}">Modifier</a></td>
                <td><a href="{{route('refuserform',[$user['id']])}}">Supprimer</a></td>
                @if($user->type=='enseignant')
                <td><a href="{{route('listcoursenseignant',[$user['id']])}}">Cours associe</a></td>
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
    </table>

@endsection
