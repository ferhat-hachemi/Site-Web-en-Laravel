@extends('modele')

@section('title','Modification de la seance')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/creation_formulaire.css') }}">

    <form action="{{route('modifierseances',['id'=>$seances->id])}}" method="post">
        <h3>Modification des seances</h3>
        @csrf
        Date_debut<br>
        <input type="date" name="date_debut" value="{{$seances->date_debut}}"><br>
        Date_fin<br>
        <input type="date" name="date_fin" value="{{$seances->date_fin}}"><br>
        <br>
        <input style="width:210px;background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" name="Modifier" value="Mettre a jour"> <br>
        <br>
        <input style="width:210px;background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" name="Annuler" value="Annuler">
    </form>
@endsection
