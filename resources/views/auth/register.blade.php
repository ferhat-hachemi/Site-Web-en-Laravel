@extends('modele')

@section('title','Inscription')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/register.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;color: black;border-color:white;">Page principale</button></a>
    <div class="form-style-8">
        <h2>Inscrivez-vous !</h2>
        <form method="post">
            @csrf
            <input type="text" name="nom" value="{{old('nom')}}" placeholder="Nom">
            <input type="text" name="prenom" value="{{old('prenom')}}" placeholder="Prenom">
            <input type="text" name="login" value="{{old('login')}}" placeholder="Login">
            <input type="password" name="mdp" placeholder="Mot de passe">
            <input type="password" name="mdp_confirmation" placeholder="Confirmation de mot de passe">
            <button style="width: 150px;background-color: #348A96;" type="submit" value="Envoyer">S'inscrire</button>
        </form>

        <p>Vous avez un compte ? <a style="text-decoration: none;color: #348A96;" href="{{route('loginform')}}">Connectez-vous</a></p>
    </div

@endsection
