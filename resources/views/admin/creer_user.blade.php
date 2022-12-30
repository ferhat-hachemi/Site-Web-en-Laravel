@extends('modele')

@section('title','Creation d`utilisateurs')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/creation_formulaire.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <form method="post">
        <h2>Creation des utilisateurs</h2>
        @csrf
        Nom<br>
        <input type="text" name="nom" placeholder="Nom" value="{{old('nom')}}"><br>
        Prenom<br>
        <input type="text" name="prenom" placeholder="Prenom" value="{{old('prenom')}}"> <br>
        Login <br>
        <input type="text" name="login" placeholder="Login" value="{{old('login')}}"> <br>
        Mot de passe <br>
        <input type="password" name="mdp" placeholder="Mot de passe"> <br>
        Confirmation mot de passe <br>
        <input type="password" name="mdp_confirmation" placeholder="Confirmation mot de passe"> <br>
        <br>
        <select id="type" name="type">
            <option value="enseignant">Enseignant</option>
            <option value="gestionnaire">Gestionnaire</option>
            <option value="admin">Admin</option>
        </select><br>
        <br>
        <button style="background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" value="Envoyer">Creer</button>
    </form>

@endsection
