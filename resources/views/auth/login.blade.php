@extends('modele')

@section('title','Connexion')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/login.css') }}">

    <a href="{{route('home')}}"><button style="background: white;color: black;border-color:white;">Page principale</button></a>
    <div class="form-style-10">
        <h1>Connectez-vous !</h1>
        <form method="post">
            @csrf
            <div class="section">Login</div>

            <div class="inner-wrap">
                <input type="text" name="login" placeholder="Login" />
            </div>

            <div class="section">Mot de passe</div>

            <div class="inner-wrap">
                <input type="password" name="mdp" placeholder="Mot de passe" />
            </div>

            <div class="button-section">
                <input type="submit" value="Se connecter" />
            </div>

            <p>Vous n'avez pas de compte ? <a  style="text-decoration: none;color:#2A88AD; " href="{{route('registerform')}}">Inscrivez-vous</a></p>
        </form>
    </div>
@endsection
