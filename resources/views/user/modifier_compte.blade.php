@extends('modele')

@section('title','Mon compte')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/creation_formulaire.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <form action="{{route('modifiercompte',['id'=>$users->id])}}" method=post>

        <h3>Mon compte</h3>
        @csrf
        Nom:<br>
        <input type="text" name="nom" value="{{$users->nom}}"><br>
        Prenom<br>
        <input type="text" name="prenom" value="{{$users->prenom}}"><br>
        Login<br>
        <input type="text" name="login" value="{{$users->login}}" disabled><br>
        <br>
        <input style="width:210px;background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" name="Modifier" value="Mettre a jour"><br>
        <br>
        <input style="width:210px;background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" name="Annuler" value="Annuler">
    </form>

@endsection
