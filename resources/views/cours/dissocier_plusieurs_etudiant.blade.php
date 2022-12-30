@extends('modele')

@section('title','Dissociation des etudiants des cours')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/association_form.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <h3>Disinscription des etudiants des cours</h3>
    <form  method="post" >
        @csrf
        <select name="etudiant_id[]" multiple>
            @foreach($cour -> etudiants as $etudiant)
                <option value = "{{$etudiant->id}}">{{$etudiant->id}} - {{$etudiant->nom}} {{$etudiant->prenom}} </option>
            @endforeach
        </select><br>
        <br>
        <input type="submit" value="Desinscrire">
    </form>
@endsection
