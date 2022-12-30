@extends('modele')

@section('title','Creation des seances')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/creation_formulaire.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <form  action="{{route('creerseances',['id'=>$cours->id])}}" method="post">
        <h3>Creation des seances</h3>
        @csrf
        <label for="date_debut">Date_debut</label><br>
        <input type="date" name="date_debut"><br>
        <label for="date_fin">Date_fin</label><br>
        <input type="date" name="date_fin"><br>
        <br>
        <button  style="background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" value="Envoyer">Creer</button>
    </form>
@endsection
