@extends('modele')

@section('title','Creation des cours')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/creation_formulaire.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <form action="{{route('creercours')}}" method="post">
        <h2>Creation des cours</h2>
        @csrf
        <label for="intitule">Intitule</label><br>
        <input type="text" name="intitule" placeholder="Intitule"><br>
        <br>
        <button  style="background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" value="Envoyer">Creer</button>
    </form>
@endsection
