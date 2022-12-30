@extends('modele')

@section('title','Modification de mot de passe')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/creation_formulaire.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <form action="{{route('modifiermotdepasse')}}" method=post>
        <h3>Changer mon mot de passe</h3>
        @csrf
        Nouveau Mot de passe<br>
        <input type="password" name="mdp" placeholder="Mot de passe"><br>
        Confirmation de mot de passe<br>
        <input type="password" name="mdp_confirmation" placeholder="Confirmation mot de passe"><br>
        <br>
        <input style="width:210px;background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" name="Modifier" value="Mettre a jour"><br>
        <br>
        <input style="width:210px;background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" name="Annuler" value="Annuler">
    </form>
@endsection
