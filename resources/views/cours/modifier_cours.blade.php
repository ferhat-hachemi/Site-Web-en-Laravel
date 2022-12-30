@extends('modele')

@section('title','Modification des cours')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/creation_formulaire.css') }}">

    <form action="{{route('modifiercours',['id'=>$cours->id])}}"  method="post">
        <h3>Modification des cours</h3>
        @csrf
        Intitule<br>
        <input type="text" name="intitule" value="{{$cours->intitule}}"><br>
        <br>
        <input style="width:210px;background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" name="Modifier" value="Mettre à jour"> <br>
        <br>
        <input style="width:210px;background-color: #2A6881;border-color: #2A6881;color:white;" type="submit" name="Annuler" value="Annuler">
    </form>
@endsection
