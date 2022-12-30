@extends('modele')

@section('title','Association des etudiants aux cours')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/association_form.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <h3>Inscription des etudiants aux cours</h3>
    <form  method="post" >
        @csrf
        <select name="etudiant_id">
            @foreach($etudiants as $etudiant)
                <option value = "{{$etudiant->id}}">{{$etudiant->id}} - {{$etudiant->nom}} {{$etudiant->prenom}} </option>
            @endforeach
        </select><br>
        <br>
        <input type="submit" value="Inscrire">
    </form>
@endsection
