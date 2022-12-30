@extends('modele')

@section('title','Dissociation des enseignants des cours')

@section('contenu')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/association_form.css') }}">

    <a href="{{route('home')}}"><button style="background-color:white;border-color:#2A6881;color:black;width:150px;">Page principale</button></a>
    <h3>Dissociation des enseignants des cours</h3>
    <form  method="post" >
        @csrf
        <select name="user_id">
            @foreach($cour->users as $user)
                <option value = "{{$user->id}}">{{$user->id}} - {{$user->nom}} {{$user->prenom}} </option>
            @endforeach
        </select><br>
        <br>
        <input type="submit" value="Dissocier">
    </form>
@endsection
