@extends('modele')

@section('title','Acceptation des utilisateurs')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/liste.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;">Page principale</button></a>
    <p>Voulez-vous accepter l'utilisateur {{$users->login}} ?</p>
    <form action="{{route('accepterutilisateurs',['id'=>$users->id])}}" method="post">
        @csrf
        Type de l'utilisateur :
        <select id="type" name="type">
            <option value="enseignant">Enseignant</option>
            <option value="gestionnaire">Gestionnaire</option>
            <option value="admin">Admin</option>
        </select>
        <button style="background-color: #2A6881;color: white;" type="submit" value="Envoyer">Accepter</button>
    </form>

@endsection
