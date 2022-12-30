@extends('modele')

@section('title','Pointage des etudiants')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/association_form.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <form  method="post" >
        <h3>Pointage des etudiants</h3>
        @csrf
        <caption>Seances</caption><br>
        <select name="seance_id" >
            @foreach($cour->seances as $seance)
                <option value = "{{$seance->id}}">{{$seance->id}}</option>

            @endforeach
        </select>  <br>
        <br>
        <caption>Etudiants</caption><br>
        <select name="etudiant_id[]" multiple>
            @foreach($cour->etudiants as $etudiant)
                <option value = "{{$etudiant->id}}">{{$etudiant->id}} - {{$etudiant->nom}} {{$etudiant->prenom}} </option>
            @endforeach
        </select> <br>
        <br>
        <input type="submit" value="Pointer">
    </form>

@endsection
